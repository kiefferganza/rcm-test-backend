<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $table = 'employees';

    public $fillable = [
        'firstname',
        'lastname',
        'email',
        'type',
        'status'
    ];

    protected $casts = [
        'firstname' => 'string',
        'lastname' => 'string',
        'email' => 'string',
        'type' => 'string',
        'status' => 'string'
    ];

    public static array $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'email|required',
        'type' => 'required|in:internal,external',
        'status' => 'required in:active,inactive'
    ];

    
}
