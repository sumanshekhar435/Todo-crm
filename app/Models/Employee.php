<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Employee extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, AuthenticableTrait;
    // protected $guard = 'employee';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
    ];
}
