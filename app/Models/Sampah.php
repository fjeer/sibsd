<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'sampah';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'jenis_sampah',
        'harga_per_kg',
        'deskripsi',
        'is_active',
    ];

    public function sampah() 
    {
        return $this->hasMany(SetorSampah::class,'sampah_id','id');
    }
}
