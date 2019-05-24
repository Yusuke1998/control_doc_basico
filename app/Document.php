<?php
// DOCUMENTO
namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'title','type','description','file','affair','person_id'
    ];
}
