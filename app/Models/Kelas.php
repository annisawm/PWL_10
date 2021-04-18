<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class Kelas extends Model
{
    use HasFactory;
    protected $table='kelas';//define this model is relate with table kelas
    
    public function mahasiswa(){
        return $this->hasMany(Mahasiswa::class);
    }
}