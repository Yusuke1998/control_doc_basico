<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'title','file','affair','person_id','document_type_id','date','user_id','code'
    ];

    public function document(){
    	return $this->hasOne(Document::class);
    }

    public function person(){
    	return $this->belongsTo(Person::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function document_type(){
    	return $this->belongsTo(Document_type::class);
    }
}
