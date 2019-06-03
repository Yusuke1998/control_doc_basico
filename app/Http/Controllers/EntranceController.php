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
        $areas = Area::all();
        $lugares = Site::all();
        return view('documentos.entradas',compact('entradas','areas','lugares'));
    }

    public function ver($id)
    {
        $dato = Entrance::find($id);
        return view('documentos.entrada-salida-show',compact('dato'));
    }

    public function store(Request $request){
        $entrada = Entrance::create($request->all());
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nueva entrada de documento: '.$entrada->document->code.' agregada exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($entrada);
    }

    public function update(Request $request, $id)
    {
        $name = Entrance::find($id)->document->code;
        $edit = Entrance::find($id)->update($request->all());
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Actualizar',
            'description'       =>  'Entrada de documento '.$name.' actualizada exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($edit);
    }

    public function editar($id){
        $entrada = Entrance::find($id);
        $entrada = [
            'id'            =>  $entrada->id,
            'from'          =>  $entrada->from,
            'to'            =>  $entrada->to,
            'date'          =>  $entrada->date,
            'commentary'    =>  $entrada->commentary,
            'area_id'       =>  $entrada->area_id,
            'site_id'       =>  $entrada->site_id,
            'code'          =>  $entrada->document->code,
            'document_id'   =>  $entrada->document->id,
        ];
        return Response()->json($entrada);
    }

    public function destroy($id)
    {
        $entrada = Entrance::find($id);
        $name = $entrada->document->code;
        $entrada->delete();
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'Entrada de documento '.$name.' eliminada exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return back();
    }
}
