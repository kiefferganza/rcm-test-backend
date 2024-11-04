<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'users';

    public $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'type',
        'status',
        'password',
    ];

    protected $casts = [
        'firstname' => 'string',
        'lastname' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'type' => 'string',
        'status' => 'string',
    ];

    public static array $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|email',
        'phone' => 'required|min:8|max:11',
        'type' => 'required|in:internal,external',
        'status' => 'required|in:active,inactive',
        'password' => 'required|min:8',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

}
