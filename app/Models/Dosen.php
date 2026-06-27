<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $primaryKey = 'nidn';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nidn', 'nama'];

    // Satu dosen membimbing banyak mahasiswa (dosen wali)
    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'nidn', 'nidn');
    }

    // Satu dosen mengajar banyak jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'nidn', 'nidn');
    }
}
