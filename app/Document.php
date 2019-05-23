<?php
// DOCUMENTO
namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'name','type','description','file','person_id'
    ];
}
