<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use App\Provider;

class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $providers = Provider::where('users_id','=',Auth::user()->id)->get();
        return view('providers.index')->with('providers',$providers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $provider = new Provider;
        $ruta = "/providers";
        $datos = ['provider' => $provider, 'ruta' => $ruta, 'edit' => false];
        return view('providers.create')->with($datos);
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
            'email' => 'unique:providers',
        ],
        [
            'email.unique' => 'Este Email ya ha sido utilizado',
        ]);
        
        $provider = new Provider;
        $provider->fill($request->all());
        $provider->users_id = Auth::user()->id;
        $provider->save();

        return redirect()->route('providers.index')->with([
            'flash_message' => "Registro guardado con éxito",
            'flash_class'   => "alert-success"
        ]);;
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
        $provider = Provider::findOrFail($id);
        $ruta = "/providers/".$id;
        $datos = ['provider' => $provider, 'ruta' => $ruta, 'edit' => true];
        return view('providers.update')->with($datos);
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
            'email' => 'unique:users',
            'email' => Rule::unique('users')->ignore($id),
        ],
        [
            'email.unique' => 'El Email ya ha sido utilizado',
        ]);

        $provider = Provider::findOrFail($id);
        $provider->fill($request->all());
        $provider->save();

        return redirect()->route('providers.index')->with([
            'flash_message' => "Registro modificado con éxito",
            'flash_class'   => "alert-success"
        ]);
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
            Provider::destroy($id);
            return redirect()->route('providers.index')->with([
                        "flash_message" => "Registro Eliminado con Éxito",
                        "flash_class" => "alert-success"
                    ]);

        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return redirect()->route('providers.index')->with([
                        "flash_message" => "No se pueden eliminar un Registro Asociado con otros.",
                        "flash_class" => "alert-danger"
                    ]);
        }
    }
}
