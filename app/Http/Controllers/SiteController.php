<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Site;
use App\Area;
use App\Binnacle;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lugares = Site::all();
        $areas = Area::all();
        return view('lugares.index',compact('lugares','areas'));
    }

    public function store(Request $request)
    {
        $lugar = Site::create($request->all());
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nuevo lugar '.$lugar->name.' agregado exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($lugar);
    }

    public function editar($id)
    {
        $lugar = Site::find($id);
        return Response()->json($lugar);
    }

    public function update(Request $request, $id)
    {
        $name = Site::find($id)->name;
        $edit = Site::find($id)->update($request->all());
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Editar',
            'description'       => 'Lugar '.$name.' editado exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($edit);
    }

    public function destroy($id)
    {
        $lugar = Site::find($id);
        $name = $lugar->name;
        $lugar->delete();

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'lugar '.$name.' eliminado exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return back();
    }

    public function lugar($id)
    {
        $lugares = Site::select('id','name')->where('area_id', $id)->orderBy('id','asc')->get();
        return $lugares;
    }
}
