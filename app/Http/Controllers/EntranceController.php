<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Binnacle;
use App\Area;
use App\Site;
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
        $areas = Area::all();
        $lugares = Site::all();
        return view('documentos.entradas',compact('entradas','documentos','areas','lugares'));
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
