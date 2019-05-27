<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
    	'ci','type_ci','firstname','lastname','phone','address'
    ];

    public function document(){
    	return $this->hasMany(Document::class);
    }

    public function user(){
    	return $this->hasOne(User::class);
    }
}
