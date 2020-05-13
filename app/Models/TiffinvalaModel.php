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
        'gender',
        'marital_status',
        'phone_number',
        'salary_def',
        'Working_hour_per_day'
    ];
}
