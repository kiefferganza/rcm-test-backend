<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Employee extends Model
{

    use Searchable;

    public $table = 'employees';

    public $fillable = [
        'firstname',
        'lastname',
        'email',
        'type',
        'phone',
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
        'email' => 'email|required',
        'phone' => 'required',
        'type' => 'required|in:internal,external',
        'status' => 'required in:active,inactive',
    ];

    public function toSearchableArray()
{
    return array_merge($this->toArray(),[
        'id' => (string) $this->id,
        'firstname' => $this->firstname,
        'lastname' => $this->lastname,
        'email' => $this->email,
        'phone' => $this->phone,
        'type' => $this->type,
        'status' => $this->status,
    ]);
}

}
