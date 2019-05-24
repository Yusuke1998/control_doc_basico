<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document_type extends Model
{
    protected $fillable = ['name'];

    public function documents(){
    	return $this->hasMany(Document::class);
    }
}
