<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'total_confirmed',
        'total_recovered',
        'total_deaths',
    ];

    public function scopeFilter($query, array $params = [])
    {
        if (isset($params['name'])) {
            $query->where('country', 'like', '%'.$params['name'].'%');
        }
    }
}
