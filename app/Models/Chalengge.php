<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chalengge extends Model
{
    use HasFactory;

    protected $table = 'chalengges';

    protected $fillable = [
        'nama_tantangan',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_berakhir',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
