<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $table = 'leads';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'kebutuhan',
        'status',
    ];
}
