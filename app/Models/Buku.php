<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'books';

    // make tgl_terbit as date
    protected $casts = [
        'tgl_terbit' => 'date',
    ];
}
