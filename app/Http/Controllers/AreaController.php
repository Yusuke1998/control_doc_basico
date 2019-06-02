<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Area;
use App\Binnacle;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $areas = Area::all();
        return view('areas.index',compact('areas',$areas));
    }

    public function store(Request $request)
    {
        $area = Area::create($request->all());
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nueva area '.$area->name.' agregada exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($area);
    }

    public function editar($id)
    {
        $area = Area::find($id);
        return Response()->json($area);
    }

    public function update(Request $request, $id)
    {
        $name = Area::find($id)->name;
        $edit = Area::find($id)->update($request->all());
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Editar',
            'description'       =>  'Area '.$name.' editada exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($edit);
    }

    public function destroy($id)
    {
        $area = Area::find($id);
        $name = $area->name;
        $area->delete();

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'Area '.$name.' eliminada exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return back();
    }
}
