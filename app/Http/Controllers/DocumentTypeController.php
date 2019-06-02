<?php

namespace App\Http\Controllers;

use App\Document_type;
use App\Binnacle;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $tipos = Document_type::all();
        return view('documentos.type',compact('tipos'));
    }

    public function store(Request $request)
    {
        $tipo = Document_type::create($request->all());
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nuevo tipo de documento '.$tipo->name.' agregado exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($tipo);
    }

    public function editar($id)
    {
        $tipo = Document_type::find($id);
        return Response()->json($tipo);
    }

    public function update(Request $request, $id)
    {
        $name = Document_type::find($id)->name;
        $edit = Document_type::find($id)->update($request->all());
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Editar',
            'description'       =>  'Tipo de documento '.$name.' editado exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($edit);
    }

    public function destroy($id)
    {
        $tipo = Document_type::find($id);
        $name = $tipo->name;
        $tipo->delete();

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'Tipo de documento '.$name.' eliminado exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return back();
    }
}
