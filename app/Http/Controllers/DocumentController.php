<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Document;
use App\Entrance;
use App\Binnacle;
use App\Delivery;
use Yajra\Datatables\Services\DataTable;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $documentos = Document::all();
        return view('documentos.index')->with('documentos',$documentos);
    }

    public function cantidad(){

    }

    public function editar(){
        
    }

    public function create()
    {
        return view('documentos.create');
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'code'              =>  'required',
                'name'              =>  'required',
                'type'              =>  'required',
                'description'       =>  'max:150',
                'date'              =>  'required',
                'status'            =>  'required',
                'file'              =>  'required'
            ]);

        $documento = Document::create([
            'code'              =>  $data['code'],
            'name'              =>  $data['name'],
            'type'              =>  $data['type'],
            'description'       =>  $data['description'],
            'unity_m'           =>  $data['unity_m'],
            'quantity'          =>  $data['quantity'],
            'date_maturity'     =>  $data['date_maturity'],
        ]);

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nuevo documento '.$documento->name.' cantidad: '.$documento->quantity.$documento->unity_m.'  agregado exitosamente!',
            'date'              =>  Carbon::now(),
        ]);

        return Response()->json($data);

    }

    public function edit($id)
    {
        return view('documentos.edit');
    }

    public function show($id)
    {
        return $id;
    }

    public function ajax($id){

        $documento = Document::find($id);
        $data = [
            'code'          =>  $documento->code,
            'name'          =>  $documento->name,
            'type'          =>  $documento->type,
            'description'   =>  $documento->description,
            'status'        =>  $documento->status,
            'file'          =>  $documento->file,
            'date'          =>  $documento->date,
        ];

        return Response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $data = request()->validate(
            [
                'code'              =>  'required',
                'name'              =>  'required',
                'type'              =>  'required',
                'description'       =>  'max:250',
                'date'              =>  'required',
                'status'            =>  'required',
                'file'              =>  'required',
            ]);

        $documento = Document::find($id);
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Editar',
            'description'       =>  'Edicion de documento '.$documento->name.'e ditado exitosamente!',
            'small_description' =>  'Edicion de documento',
            'date'              =>  Carbon::now(),
        ]);
        
        return json_encode($request);
    }


    public function eliminar($id)
    {
        $documento = Document::find($id);
        $name = $documento->name;
        $documento->delete();

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'documento '.$name.' eliminado exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return back();
    }

    public function entradas_ultimas(){

    }

    public function salidas_ultimas(){
        
    }

    public function entradas($id)
    {
        $data = Document::find($id)->entrances()->get();
        if($data == '[]'){
                return Response()->json(['info'=>'No hay datos']);
        }
        else
        {
            return Response()->json($data->all());
        }
    }

    public function salidas($id)
    {
        $data = Document::find($id)->deliverys()->get();
        if($data == '[]'){
                return Response()->json(['info'=>'No hay datos']);
        }
        else
        {
            return Response()->json($data->all());
        }
    }
}
