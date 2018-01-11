<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Trademark;


class TradeMarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $trademark = Trademark::where('users_id','=',Auth::user()->id)->get();
        return view('trademark.index')->with('trademark',$trademark);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $trademark = new Trademark;
        $ruta = "/trademark";
        $datos = ['trademark' => $trademark, 'ruta' => $ruta, 'edit' => false];
        return view('trademark.create')->with($datos);
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
        $trademark = new Trademark;
        $trademark->fill($request->all());
        $trademark->users_id = Auth::user()->id;
        $trademark->save();

        return redirect()->route('trademark.index')->with([
            'flash_message' => "Registro guardado con éxito",
            'flash_class'   => "alert-success"
        ]);
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
        $trademark = Trademark::findOrFail($id);
        $ruta = "/trademark/".$id;
        $datos = ['trademark' => $trademark, 'ruta' => $ruta, 'edit' => true];
        return view('trademark.update')->with($datos);
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

        $trademark = Trademark::findOrFail($id);
        $trademark->fill($request->all());
        $trademark->save();

        return redirect()->route('trademark.index')->with([
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

            Trademark::destroy($id);
            
            return redirect()->route('trademark.index')->with([
                'flash_message' => 'Registro eliminado con éxito',
                'flash_class'   => 'alert-success'
            ]);
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return redirect()->route('trademark.index')->with([
                        "flash_message" => "No se pueden eliminar un Registro Asociado con otros.",
                        "flash_class" => "alert-danger"
                    ]);
        }
    }
}
