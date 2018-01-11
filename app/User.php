<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user', 'password','nombre_farmacia','number','email', 'nivel','estado','municipio','parroquia','status','rol'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function estados()
    {
        return $this->hasOne('App\Estado','id','estado');
    }

    public function municipios($estado)
    {
        return  $this->hasOne('App\Municipio','id_municipio','municipio')->where('id_estado','=',$estado)->first();   
    }

    public function parroquias($estado,$municipio)
    {
        return $this->hasOne('App\Parroquia','id','parroquia')->where([ ['id_estado','=',$estado],['id_municipio','=',$municipio] ])->first();      
    }

    public function authorized()
    {
        $validate = false;

        if(Auth::user()->rol === 1)
        {
            $validate = true;
        }
        
        return $validate;
    }
}
