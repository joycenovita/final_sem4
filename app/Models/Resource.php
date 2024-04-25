<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $table = 'resources';

    protected $fillable = ['judul', 'deskripsi', 'tautan', 'kategori', 'user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


