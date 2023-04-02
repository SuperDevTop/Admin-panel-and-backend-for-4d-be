<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'company',
        'number',
        'big',
        'small',
        'ticketno',
        'total'
    ];
}
