<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $table = 'customer_master';
    public $timestamp = false;
    protected $fillable = [
        'id',
        'l_name',
        'f_name',
        'm_name',
        'email',
        'age',
        'occupation',
        'marital_status',
        'gender',
        'phone_number',
        'Present_member'
    ];
}
