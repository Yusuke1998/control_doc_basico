<?php
// DOCUMENTO
namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'header','text','from','to','affair','person_id','document_type_id','date','user_id','code','file_id','title'
    ];

    public function file(){
        return $this->belongsTo(File::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function person(){
    	return $this->belongsTo(Person::class);
    }
    
    public function document_type(){
    	return $this->belongsTo(Document_type::class);
    }

    public function entrance(){
        return $this->hasOne(Entrance::class);
    }

    public function delivery(){
        return $this->hasOne(Delivery::class);
    }
}
