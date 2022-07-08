<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'country',
        'total_confirmed',
        'total_recovered',
        'total_deaths',
    ];

    use HasFactory;
}
