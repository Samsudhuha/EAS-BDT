<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjams extends Model
{
    use HasFactory;

    protected $fillable = [
        'buku_id', 'peminjam', 'jaminan', 'tanggal_pinjam', 'tanggal_kembali', 'flag_kembali', 'denda'
    ];

    public function Buku()
    {
        return $this->hasOne(Books::class, 'id', 'buku_id');
    }
}
