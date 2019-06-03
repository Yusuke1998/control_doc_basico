<?php
// ENTRADAS
namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrance extends Model
{
    protected $fillable = [
    	'date','commentary','from','to','area_id','site_id','document_id'
    ];

    public function document(){
    	return $this->hasOne(Document::class);
    }

    public function area(){
    	return $this->belongsTo(Area::class);
    }

    public function site(){
    	return $this->belongsTo(Site::class);
    }
}
