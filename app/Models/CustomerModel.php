<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $table = 'customer_master';
    public $timestamps = false;
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
        'address',
        'pincode',
        'phone_number',
        'Present_member'
    ];
}
