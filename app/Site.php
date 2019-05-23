<?php
// UBICACION
namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
    	'site','area_id','document_id',
    ];

    public function area(){
    	return $this->belognsTo(Area::class);
    }

    public function documents(){
    	return $this->hasMany(Product::class);
    }
}
