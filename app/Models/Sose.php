<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sose extends Model
{
    use HasFactory;
    protected $fillable = [
        'ride_id',
        'user_name',
        'driver_name',
        'status'
    ];
}
