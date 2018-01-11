<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\Estado;
use App\Municipio;
use App\Parroquia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all(); 
        return view('users.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = new User;
        $estados = Estado::select('id','estado')->get();
        $ruta = "/users";
        $datos = ['user' => $user, 'ruta' => $ruta, 'edit' => false,'estados' => $estados, 'municipios' => [], 'parroquias' => []];
        return view('users.create')->with($datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'user' => 'unique:users',
            'email' => 'unique:users',
            'nombre_farmacia' => 'unique:users'
        ],
        [
            'user.unique' => 'Este Usuario ya ha sido utilizado',
            'email.unique' => 'Este Email ya ha sido utilizado',
            'nombre_farmacia.unique' => 'Este Nombre de Farmacia ya ha sido utilizado'
        ]);
        
        $user = new User;
        $user->fill($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('users.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);
        $estados = Estado::select('id','estado')->get();
        $municipios = Municipio::municipios_por_estado($user->estado);
        $parroquias = Parroquia::parroquias($user->estado,$user->municipio);

        $ruta = "/users/".$id;
        $datos = ['user' => $user, 'ruta' => $ruta, 'edit' => true,'estados' => $estados,'municipios' => $municipios,'parroquias' => $parroquias];
        
        return view('users.update')->with($datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'user' => 'unique:users',
            'email' => 'unique:users',
            'nombre_farmacia' => 'unique:users',
            'email' => Rule::unique('users')->ignore($id),
            'user' => Rule::unique('users')->ignore($id),    
            'nombre_farmacia' => Rule::unique('users')->ignore($id),
        ],
        [
            'user.unique' => 'Este Usuario ya ha sido utilizado',
            'email.unique' => 'Este Email ya ha sido utilizado',
            'nombre_farmacia.unique' => 'Este Nombre de Farmacia ya ha sido utilizado'
        ]);

        $user = User::findOrFail($id);
        $user->fill($request->all());
        $user->save();

        return redirect()->route('users.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try
        {
            User::destroy($id);
            return redirect()->route('users.index')->with([
                        "flash_message" => "Registro Eliminado con Éxito",
                        "flash_class" => "alert-success"
                    ]);

        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return redirect()->route('users.index')->with([
                        "flash_message" => "No se pueden eliminar un Registro Asociado con otros.",
                        "flash_class" => "alert-danger"
                    ]);
        }
    }
}
