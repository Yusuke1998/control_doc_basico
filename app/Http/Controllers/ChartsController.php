<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartsController extends Controller
{
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
        $entradas       = Entrance::all()->count();
        $salidas        = Delivery::all()->count();

        $data = [$documentos,$entradas,$salidas];

        return Response()->json($data);
    }
}