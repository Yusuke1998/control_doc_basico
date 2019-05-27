<?php
// DOCUMENTO
namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'title','header','text','from','to','file','affair','person_id','document_type_id','date','user_id'
    ];

    public function document_type(){
    	return $this->belongsTo(Document_type::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function person(){
    	return $this->belongsTo(Person::class);
    }
}
