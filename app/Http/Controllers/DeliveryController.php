<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Area;
use App\Site;
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
        $areas = Area::all();
        $lugares = Site::all();
        return view('documentos.salidas',compact('salidas','areas','lugares'));
    }

    public function ver($id)
    {
        $dato = Delivery::find($id);
        return view('documentos.entrada-salida-show',compact('dato'));
    }

    public function store(Request $request){
        $salida = Delivery::create($request->all());
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nueva salida de documento: '.$salida->document->code.' agregada exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($salida);
    }

    public function update(Request $request, $id)
    {
        $name = Delivery::find($id)->document->code;
        $edit = Delivery::find($id)->update($request->all());
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Actualizar',
            'description'       =>  'Salida de documento '.$name.' actualizada exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($edit);
    }

    public function editar($id){
        $salida = Delivery::find($id);
        $salida = [
            'id'            =>  $salida->id,
            'from'          =>  $salida->from,
            'to'            =>  $salida->to,
            'date'          =>  $salida->date,
            'commentary'    =>  $salida->commentary,
            'area_id'       =>  $salida->area_id,
            'site_id'       =>  $salida->site_id,
            'code'          =>  $salida->document->code,
            'document_id'   =>  $salida->document->id,
        ];
        return Response()->json($salida);
    }

    public function destroy($id)
    {
        $salida = Delivery::find($id);
        $name = $salida->document->code;
        $salida->delete();
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'Salida de documento '.$name.' eliminada exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return back();
    }

}
