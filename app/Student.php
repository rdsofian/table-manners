<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['code', 'name', 'birth_place', 'birth_date', 'address', 'phone', 'email' , 'group', 'ipk', 'year'];
}
