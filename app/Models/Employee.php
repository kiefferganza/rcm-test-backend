<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $table = 'employees';

    public $hidden = [
        'password',
        'remember_token',
    ];

    public $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'type',
        'status',
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
    ];

}
