<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model // Definisi Model
{
    protected $table="mahasiswa";
    protected $primaryKey = 'nim';

    protected $fillable = [
        'nim',
        'nama',
        'kelas_id',
        'jurusan',
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function matakuliah(){
        return $this->belongsToMany(MataKuliah::class, 'mahasiswa_matakuliah', 'mahasiswa_id', 'matakuliah_id')->withPivot('nilai');
    }
}