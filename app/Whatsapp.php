<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Whatsapp extends Model
{
    protected $fillable = ['user_id', 'department', 'message'];
}
