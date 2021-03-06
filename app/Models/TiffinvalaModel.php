<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiffinvalaModel extends Model
{
    protected $table = 'tiffinvala_master';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'l_name',
        'f_name',
        'm_name',
        'age',
        'password',
        'gender',
        'marital_status',
        'phone_number',
        'address',
        'salary_def',
        'number_of_orders'
    ];
}
