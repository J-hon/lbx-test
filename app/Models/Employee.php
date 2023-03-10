<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'username',
        'name_prefix',
        'first_name',
        'middle_initial',
        'last_name',
        'last_name',
        'gender',
        'email',
        'date_of_birth',
        'time_of_birth',
        'age',
        'date_of_joining',
        'age_in_company',
        'phone',
        'place_name',
        'county',
        'city',
        'zip',
        'region'
    ];
}
