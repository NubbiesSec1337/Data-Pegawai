<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    
    // Jika ada atribut tambahan, tambahkan di sini
    protected $fillable = ['nama', 'email', 'posisi', 'tanggal_lahir'];
}
