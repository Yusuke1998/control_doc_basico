<?php
// UBICACION
namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
    	'name','area_id','description',
    ];

    public function area(){
    	return $this->belongsTo(Area::class);
    }

    public function entrances(){
    	return $this->hasMany(Entrance::class);
    }

    public function deliveries(){
    	return $this->hasMany(Delivery::class);
    }
}
