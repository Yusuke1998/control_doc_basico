<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\File;
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
                'code'               =>  $code,
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

    public function show(File $file)
    {
        return  $file->all();
    }

    public function edit(File $file)
    {
        //
    }

    public function update(Request $request, File $file)
    {
        //
    }

    public function destroy(File $file)
    {
        //
    }
}
