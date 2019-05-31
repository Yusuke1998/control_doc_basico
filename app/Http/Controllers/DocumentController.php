<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Document;
use App\File;
use App\Person;
use App\Document_type;
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
        $tipos = Document_type::all();
        return view('documentos.index',compact('documentos','tipos'));
    }


    public function all(Request $request){
        $documentos = DB::table('documents')
        ->join('document_types','document_types.id','=','documents.document_type_id')
        ->join('people','people.id','=','documents.person_id')
        ->select('documents.id as id','people.ci as ci','title','from','to','affair','date','document_types.name as type')->get();
        $documentos = ['data'=>$documentos];
        return $documentos;
    }

    public function cantidad(){
        $documentos = Document::all()->count();
        return $documentos;
    }

    public function editar($id){
        $documento = Document::find($id);
        $data = [
            'code'               =>  $documento->code,
            'ci'                 =>  $documento->person->ci,
            'title'              =>  $documento->title,
            'header'             =>  $documento->header,
            'text'               =>  $documento->text,
            'from'               =>  $documento->from,
            'to'                 =>  $documento->to,
            'file'               =>  $documento->file,
            'affair'             =>  $documento->affair,
            'date'               =>  $documento->date,
            'person_id'          =>  $documento->person_id,
            'user_id'            =>  $documento->user_id,
            'document_type_id'   =>  $documento->document_type_id,
        ];
        return Response()->json($data);
    }

    public function store(Request $request)
    {
        $user_id = \Auth::User()->id;
        $code = time().'COD';
        $persona = Person::where('ci',$request->ci)->first();
        if (is_null($persona)) {
            $persona = Person::create([
                'ci'        =>  $request->ci,
            ]);
        }
        $documento = Document::create([
            'code'               =>  $code,
            'title'              =>  $request->title,
            'header'             =>  $request->header,
            'text'               =>  $request->text,
            'from'               =>  $request->from,
            'to'                 =>  $request->to,
            'affair'             =>  $request->affair,
            'date'               =>  $request->date,
            'person_id'          =>  $persona->id,
            'user_id'            =>  $user_id,
            'document_type_id'   =>  $request->document_type_id,
        ]);
        if ($request->file('file')) {
            $file = $request->file('file');
            $name_file = time().'.'.$file->getClientOriginalExtension();
            $path = public_path().'\archivos';
            $file->move($path,$name_file);
            $archivo = File::create([
                'code'               =>  $code,
                'title'              =>  $request->title,
                'file'               =>  $name_file,
                'affair'             =>  $request->affair,
                'date'               =>  $request->date,
                'person_id'          =>  $persona->id,
                'user_id'            =>  $user_id,
                'document_type_id'   =>  $request->document_type_id,
            ]);
            if ($archivo) {
                $documento->file_id = $archivo->id;
                $documento->save();
            }
        }
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nuevo documento '.$documento->title.' agregado exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json($request->all());
    }

    public function show($id){
        $documento = Document::find($id);
        $documento = [
            'code'      => $documento->code,
            'title'     => $documento->title,
            'header'    => $documento->header,
            'from'      => $documento->from,
            'to'        => $documento->to,
            'text'      => $documento->text,
            'affair'    => $documento->affair,
            'date'      => date('d/m/Y',strtotime($documento->date)),
            'person'    => $documento->person->firstname.' '.$documento->person->lastname,
            'user'      => $documento->user->person->firstname.' '.$documento->user->person->lastname,
            'ci'        => $documento->user->person->ci,
            'position'  => $documento->user->person->position,
            'file_id'      => isset($documento->file)?$documento->file->id:''
        ];
        return view('documentos.show',compact('documento'));
    }

    public function update(Request $request, $id)
    {
        $user_id = \Auth::User()->id;
        $persona = Person::where('ci',$request->ci)->first();
        if (is_null($persona)) {
            $persona = Person::create([
                'ci'        =>  $request->ci
            ]);
        }
        $documento = Document::find($id)->update([
            'title'              =>  $request->title,
            'header'             =>  $request->header,
            'text'               =>  $request->text,
            'from'               =>  $request->from,
            'to'                 =>  $request->to,
            'affair'             =>  $request->affair,
            'date'               =>  $request->date,
            'person_id'          =>  $persona->id,
            'user_id'            =>  $user_id,
            'document_type_id'   =>  $request->document_type_id,
        ]);
        if ($request->file('file')) {
            $file = $request->file('file');
            $name_file = time().'.'.$file->getClientOriginalExtension();
            $path = public_path().'\archivos';
            $file->move($path,$name_file);

            if (is_null($documento->file_id)) {
                $archivo = File::create([
                    'code'               =>  $documento->code,
                    'title'              =>  $request->title,
                    'file'               =>  $name_file,
                    'affair'             =>  $request->affair,
                    'date'               =>  $request->date,
                    'person_id'          =>  $persona->id,
                    'user_id'            =>  $user_id,
                    'document_type_id'   =>  $request->document_type_id,
                ]);
            }else{
                $archivo = File::find($documento->file_id)->update([
                    'code'               =>  $request->code,
                    'title'              =>  $request->title,
                    'file'               =>  $name_file,
                    'affair'             =>  $request->affair,
                    'date'               =>  $request->date,
                    'person_id'          =>  $persona->id,
                    'user_id'            =>  $user_id,
                    'document_type_id'   =>  $request->document_type_id,
                ]);
            }

        }
        $documento = Document::find($id);
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Editar',
            'description'       =>  'Edicion de documento '.$documento->title.' con exito!',
            'small_description' =>  'Edicion de documento',
            'date'              =>  Carbon::now(),
        ]);
        return json_encode($request);
    }


    public function destroy($id)
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
        return Response()->json(['info'=>'Eliminado con exito!']);
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
