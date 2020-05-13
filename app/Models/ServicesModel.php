<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesModel extends Model
{
    protected $table = 'services';
    public $timestamps = false;
    protected $fillable = [
        'service_id',
        'customer_id',
        'tiffinvala_id',
        'valid_dest',
        'working',
        'service_val'
    ];
}
