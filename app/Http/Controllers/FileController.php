<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\File;
use App\Person;
use App\Document;
use App\Binnacle;
use App\Document_type;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        $tipos = Document_type::all();
        $archivos = File::all();
        return view('archivos.index',compact('archivos','tipos'));
    }

    public function all(Request $request){
        $archivos = DB::table('files')
        ->join('document_types','document_types.id','=','files.document_type_id')
        ->join('people','people.id','=','files.person_id')
        ->select('files.id as id','people.ci as ci','title','affair','date','document_types.name as type')->get();

        $archivos = ['data'=>$archivos];
        return $archivos;
    }

    public function cantidad(){
        $archivos = File::all()->count();
        return $archivos;
    }

    public function editar($id){
        $archivo = File::find($id);
        $data = [
            'id'                 =>  $archivo->id,
            'ci'                 =>  $archivo->person->ci,
            'code'               =>  $archivo->code,
            'title'              =>  $archivo->title,
            'affair'             =>  $archivo->affair,
            'date'               =>  $archivo->date,
            'person_id'          =>  $archivo->person_id,
            'user_id'            =>  $archivo->user_id,
            'document_type_id'   =>  $archivo->document_type_id,
        ];

        return Response()->json($data);
    }

    public function store(Request $request)
    {
        $user_id = \Auth::User()->id;

        $persona = Person::create([
            'ci'        =>  $request->ci,
        ]);

        if ($request->file('file')) {
            $file = $request->file('file');
            $name_file = time().'.'.$file->getClientOriginalExtension();
            $path = public_path().'\archivos';
            $file->move($path,$name_file);

            $archivo = File::create([
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

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nuevo archivo '.$archivo->title.' agregado exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
    }

    public function show($id)
    {
        $archivo = File::find($id);
        $archivo = [
            'id'      => $archivo->id,
            'code'      => $archivo->code,
            'title'     => $archivo->title,
            'affair'    => $archivo->affair,
            'date'      => date('d/m/Y',strtotime($archivo->date)),
            'person'    => $archivo->person->firstname.' '.$archivo->person->lastname,
            'user'      => $archivo->user->person->firstname.' '.$archivo->user->person->lastname,
            'ci'        => $archivo->person->ci,
            'file'      => $archivo->file,
        ];
        return view('archivos.show',compact('archivo'));
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
        if ($request->file('file')) {
            $file = $request->file('file');
            $name_file = time().'.'.$file->getClientOriginalExtension();
            $path = public_path().'\archivos';
            $file->move($path,$name_file);
            $archivo = File::find($id)->update([
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
        $archivo = File::find($id);
        if ($archivo->document()) {
            $archivo->document->update([
                'code'              =>  $archivo->code,
                'title'             =>  $archivo->title,
                'file'              =>  $archivo->file,
                'affair'            =>  $archivo->affair,
                'date'              =>  $archivo->date,
                'person_id'         =>  $archivo->person_id,
                'user_id'           =>  $archivo->user_id,
                'document_type_id'  =>  $archivo->document_type_id,
            ]);
        }
        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Editar',
            'description'       =>  'Edicion de archivo '.$archivo->title.' con exito!',
            'small_description' =>  'Edicion de archivo',
            'date'              =>  Carbon::now(),
        ]);
        return json_encode($request);
    }

    public function descargar($id){
        return $id;
    }

    public function destroy($id)
    {
        $archivo = File::find($id);
        $name = $archivo->name;
        $archivo->delete();

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'archivo '.$name.' eliminado exitosamente!',
            'date'              =>  Carbon::now(),
        ]);
        return Response()->json(['info'=>'Eliminado con exito!']);
    }
}
