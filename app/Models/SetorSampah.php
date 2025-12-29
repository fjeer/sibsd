<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetorSampah extends Model
{
    use HasFactory;

    protected $table = 'setor_sampah';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nasabah_id',
        'sampah_id',
        'petugas_id',
        'berat',
        'total_poin',
        'tanggal_transaksi'
    ];

    public function nasabah() 
    {
        return $this->belongsTo(User::class,'nasabah_id','id');
    }

    public function sampah() 
    {
        return $this->belongsTo(Sampah::class,'sampah_id','id');
    }

    public function petugas() 
    {
        return $this->belongsTo(User::class, 'petugas_id','id');
    }
}
