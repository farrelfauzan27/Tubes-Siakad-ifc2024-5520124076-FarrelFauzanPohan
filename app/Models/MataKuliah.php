<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'matakuliahs';
    protected $primaryKey = 'kode_matakuliah';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['kode_matakuliah', 'nama_matakuliah', 'sks'];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    public function mahasiswas()
    {
        return $this->belongsToMany(Mahasiswa::class, 'krs', 'kode_matakuliah', 'npm')
            ->withTimestamps();
    }
}
