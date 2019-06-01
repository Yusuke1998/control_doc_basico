<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document_type extends Model
{
    protected $fillable = ['name','description'];

    public function documents(){
    	return $this->hasMany(Document::class);
    }

    public function files(){
    	return $this->hasMany(File::class);
    }
}
