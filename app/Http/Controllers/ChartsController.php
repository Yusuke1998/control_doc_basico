<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\File;
use App\Entrance;
use App\Delivery;

class ChartsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }
    
    public function index(){

    }

    public function charts_entradas_salidas(){

    }

    public function charts_entradas(){
        
    }

    public function charts_salidas(){
        
    }

    public function charts()
    {
        $documentos     = Document::all()->count();
        $archivos       = File::all()->count();
        $entradas       = Entrance::all()->count();
        $salidas        = Delivery::all()->count();

        $data = [$documentos,$archivos,$entradas,$salidas];

        return Response()->json($data);
    }
}
