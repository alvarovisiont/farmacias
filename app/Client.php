<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = ['users_id','cedula','name_complete','gender','address','number','email'];
}
