<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'image',
        'lokasi_id',
    ];

    public function Lokasi()
    {
        return $this->hasOne(Raks::class, 'id', 'lokasi_id');
    }
}
