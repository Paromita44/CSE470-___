<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    use HasFactory;

    // Define your fillable attributes or relationships here
    protected $fillable = ['user_id', 'contact_name', 'contact_phone'];
}