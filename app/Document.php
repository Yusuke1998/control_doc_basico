<?php
// DOCUMENTO
namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'code','name','type','description','status','file','date'
    ];

    public function area(){
    	return $this->belongsTo(Area::class);
    }

    public function site(){
    	return $this->belongsTo(Site::class);
    }

    public function entrances(){
    	return $this->hasMany(Entrance::class);
    }

    public function deliverys(){
    	return $this->hasMany(Delivery::class);
    }
}
