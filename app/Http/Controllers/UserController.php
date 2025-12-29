<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('profile');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('email', 'like', "%{$request->search}%")
                    ->orWhere('username', 'like', "%{$request->search}%")
                    ->orWhereHas('profile', function ($q2) use ($request) {
                        $q2->where('full_name', 'like', "%{$request->search}%");
                    })
                    ->orWhereHas('profile', function ($q3) use ($request) {
                        $q3->where('address', 'like', "%{$request->search}%");
                    });
            });
        }

        if ($request->role && auth()->user()->role === 'admin') {
            $query->where('role', $request->role);
        }

        if ($request->trashed && auth()->user()->role === 'admin') {
            if ($request->trashed === 'only') {
                $query->onlyTrashed();
            } elseif ($request->trashed === 'with') {
                $query->withTrashed();
            } else {
                $query->withoutTrashed();
            }
        }

        if (auth()->user()->role == 'petugas') {
            $query->where('role', 'nasabah');
        }

        $users = $query->latest()->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|in:admin,petugas,nasabah',

            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',

            'full_name' => 'required',
            'phone_number' => 'nullable|numeric|max:20',
            'address' => 'nullable',
            'gender' => 'nullable|in:male,female',
        ]);

        $nin = null;

        if ($validated['role'] === 'nasabah') {
            $prefix = date('y') . date('d') . date('m');

            $last = Profile::where('nin', 'like', "$prefix%")
                ->orderByDesc('nin')
                ->first();

            $seq = $last ? str_pad((int) substr($last->nin, -4) + 1, 4, '0', STR_PAD_LEFT) : '0001';
            $nin = $prefix . $seq;
        }

        $user = User::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'is_active' => true,
        ]);

        $user->profile()->create([
            'nin' => $nin,
            'full_name' => $validated['full_name'],
            'phone_number' => $validated['phone_number'] ?? null,
            'address' => $validated['address'] ?? null,
            'gender' => $validated['gender'] ?? null,
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validate = $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,petugas,nasabah',
            'full_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'gender' => 'nullable|in:male,female',
        ]);

        /* ================= USER ================= */
        $user->update([
            'username' => $validate['username'],
            'email' => $validate['email'],
            'role' => $validate['role'],
        ]);

        /* ================= NIN LOGIC ================= */
        $nin = null;

        if ($validate['role'] === 'nasabah') {
            // ambil NIN lama jika ada
            $nin = $user->profile?->nin;
        }

        /* ================= PROFILE ================= */
        if ($user->profile) {
            $user->profile->update([
                'nin' => $nin,
                'full_name' => $validate['full_name'],
                'phone_number' => $validate['phone_number'] ?? null,
                'address' => $validate['address'] ?? null,
                'gender' => $validate['gender'] ?? null,
            ]);
        } else {
            $user->profile()->create([
                'nin' => $nin,
                'full_name' => $validate['full_name'],
                'phone_number' => $validate['phone_number'] ?? null,
                'address' => $validate['address'] ?? null,
                'gender' => $validate['gender'] ?? null,
            ]);
        }

        return redirect()
            ->route('user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active' => false]);
        $user->save();

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus.');
    }
}
