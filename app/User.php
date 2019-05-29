<?php
// USUARIO
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','type','person_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function binnacles(){
    	return $this->hasMany(Binnacle::class);
    }

    public function documents(){
        return $this->hasMany(Document::class);
    }

    public function files(){
        return $this->hasMany(File::class);
    }

    public function person(){
        return $this->belongsTo(Person::class);
    }
}
