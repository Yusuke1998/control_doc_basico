<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Binnacle;
use App\Delivery;
use App\Document;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $salidas = Delivery::all();
        $documentos = Document::all();
        return view('salidas',compact('salidas','documentos'));
    }

    public function editar($id){
        $salida = Delivery::find($id);
        return Response()->json($salida);
    }

    public function ver($id)
    {
        return 'Soy la salida '.$id;
    }

}
