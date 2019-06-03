<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\User;
use App\Person;
use App\Binnacle;
use Yajra\Datatables\Services\DataTable;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index',compact('usuarios'));
    }

    public function cantidad(){

    }

    public function editar($id){
        $usuario = User::find($id);
        $usuario = [
            'id'        =>  $usuario->id,
            'name'      =>  $usuario->name,
            'email'     =>  $usuario->email,
            'type'      =>  $usuario->type,
            'firstname' =>  $usuario->person->firstname,
            'lastname'  =>  $usuario->person->lastname,
            'ci'        =>  $usuario->person->ci,
            'type_ci'   =>  $usuario->person->type_ci,
            'position'  =>  $usuario->person->position,
            'address'   =>  $usuario->person->address,
            'phone'     =>  $usuario->person->phone,
        ];

        return Response()->json($usuario);
    }

    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $password = User::find($id)->password;
        if (!empty($request->password)&&bcrypt($request->password)!=$password) {
            $usuario->password = bcrypt($request->password);
        }
        $usuario->type = $request->type;
        $usuario->save();

        $usuario->person->update([
            'ci'        =>  $request->ci,
            'type_ci'   =>  $request->type_ci,
            'firstname' =>  $request->firstname,
            'lastname'  =>  $request->lastname,
            'phone'     =>  $request->phone,
            'address'   =>  $request->address,
            'position'  =>  $request->position
        ]);

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Actualizar',
            'description'       =>  'Edicion de usuario '.$usuario->name.' / '.$usuario->email.' / '.$usuario->type.' realizada exitosamente!',
            'small_description' =>  'Actualizacion de usuario',
            'date'              =>  Carbon::now(),
        ]);

        return Response()->json(['info'=>'Exito']);
    }

    public function store(Request $request)
    {
        $persona = Person::create([
            'ci'        =>  $request->ci,
            'type_ci'   =>  $request->type_ci,
            'firstname' =>  $request->firstname,
            'lastname'  =>  $request->lastname,
            'phone'     =>  $request->phone,
            'address'   =>  $request->address,
            'position'  =>  $request->position
        ]);
        $usuario = User::create([
            'name'      =>  $request->name,
            'type'      =>  $request->type,
            'email'     =>  $request->email,
            'password'  =>  bcrypt($request->password),
            'person_id' =>  $persona->id
        ]);

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Crear',
            'description'       =>  'Nuevo usuario '.$usuario->name.' / '.$usuario->email.' / '.$usuario->type.' agregado exitosamente!',
            'small_description' =>  'Nuevo registro de usuario',
            'date'              =>  Carbon::now(),
        ]);

        return Response()->json(['info'=>'Exito']);
    }

    public function destroy($id)
    {
        $usuario = User::find($id);
        $name = $usuario->name;
        $email = $usuario->email;
        $type = $usuario->type;
        $usuario->delete();

        $bitacora = Binnacle::create([
            'user_id'           => \Auth::User()->id,
            'action'            =>  'Eliminar',
            'description'       =>  'Usuario '.$name.' / '.$email.' / '.$type.' eliminado exitosamente!',
            'small_description' =>  'Usuario eliminado',
            'date'              =>  Carbon::now(),
        ]);
    }
}
