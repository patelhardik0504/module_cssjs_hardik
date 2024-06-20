<?php

namespace Modules\Providers\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Provider extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password'
    ];
}
