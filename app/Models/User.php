<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User_solutions;


class User extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $fillable = ['username', 'password', 'is_admin'];
    public function solutions()
    {
        return $this->hasMany(User_solutions::class);
    }
}
