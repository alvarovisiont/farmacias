<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Group;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $group = Group::where('users_id','=',Auth::user()->id)->get();
        return view('group.index')->with('group',$group);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $group = new Group;
        $ruta = "/group";
        $datos = ['group' => $group, 'ruta' => $ruta, 'edit' => false];
        return view('group.create')->with($datos);
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
        $group = new Group;
        $group->fill($request->all());
        $group->users_id = Auth::user()->id;
        $group->save();

        return redirect()->route('group.index')->with([
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
        $group = Group::findOrFail($id);
        $ruta = "/group/".$id;
        $datos = ['group' => $group, 'ruta' => $ruta, 'edit' => true];
        return view('group.update')->with($datos);
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
        $group = Group::findOrFail($id);
        $group->fill($request->all());
        $group->save();

        return redirect()->route('group.index')->with([
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

            Group::destroy($id);
            
            return redirect()->route('group.index')->with([
                'flash_message' => 'Registro eliminado con éxito',
                'flash_class'   => 'alert-success'
            ]);
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return redirect()->route('group.index')->with([
                        "flash_message" => "No se pueden eliminar un Registro Asociado con otros.",
                        "flash_class" => "alert-danger"
                    ]);
        }
    }
}
