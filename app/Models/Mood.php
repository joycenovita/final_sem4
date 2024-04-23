<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    use HasFactory;

    protected $table = 'moods';

    protected $fillable = [
        'nama_mood',
        'keterangan',
        'warna',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
