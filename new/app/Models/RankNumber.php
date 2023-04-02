<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankNumber extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'company',
        'rank',
        'ranknumber'
    ];
}
