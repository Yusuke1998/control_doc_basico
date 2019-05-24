<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Binnacle;
use App\Entrance;
use App\Document;

class EntranceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $entradas = Entrance::all();
        $documentos = Document::all();
        return view('entradas',compact('entradas','documentos'));
    }

    public function editar($id){
        $entrada = Entrance::find($id);
        return Response()->json($entrada);
    }

    public function ver($id)
    {
        return 'Soy la entrada '.$id;
    }

}
