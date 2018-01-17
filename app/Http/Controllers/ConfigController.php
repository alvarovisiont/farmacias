<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Config;

use Image;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('config.index')->with('config',Config::where('user_id','=',Auth::user()->id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $config = new Config;
        $ruta   = 'config';
        $datos = ['config' => $config, 'ruta' => $ruta, 'edit' => false];

        return view('config.create')->with($datos);
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
        request()->validate([

            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'image.mimes' => 'La imagen debe ser de formato jpeg o png',
            'image.max' => 'La imagen no debe ser superior a 2 mb',
        ]);

        $imageName = "";

        if($request->logo)
        {
            $imageName = time().'.'.request()->logo->getClientOriginalExtension();

            $path = public_path('img/logo/').$imageName;
            
            Image::make(request()->logo->getRealPath())->resize(1300, 200)->save($path);
        }
            
        

        $config = new Config;
        $config->fill($request->all());
        $config->logo = $imageName;
        $config->user_id = Auth::user()->id;

        $config->save();

        return redirect()->route('config.index')->with([
            'flash_message' => "Configuración guardada con éxito",
            'flash_class'   => "alert-success"
        ]);


        //$imageName = time().'.'.request()->image->getClientOriginalExtension();

        //request()->image->move(public_path('images'), $imageName);

        
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
        $config = Config::findOrFail($id);
        $ruta   = 'config/'.$id;
        $datos = ['config' => $config, 'ruta' => $ruta, 'edit' => true];

        return view('config.create')->with($datos);
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
        request()->validate([

            'logo' => 'image|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'image.mimes' => 'La imagen debe ser de formato jpeg o png',
            'image.max' => 'La imagen no debe ser superior a 2 mb',
        ]);

        $config = Config::findOrFail($id);
        $imageName = $config->logo;

        $config->fill($request->all());
        

        if($request->logo)
        {
            if($imageName !== "" && file_exists( public_path('img\logo\\').$imageName ))
            {
                unlink(public_path('img\logo\\').$imageName);
            }

            $imageName = time().'.'.request()->logo->getClientOriginalExtension();
            request()->logo->move(public_path('img/logo'), $imageName);

            $config->logo = $imageName;
        }
            
        $config->logo = $imageName;
        $config->save();

        return redirect()->route('config.index')->with([
            'flash_message' => "Configuración modificada con éxito",
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
            $config = Config::findOrFail($id);

            if($config->logo !== "" && file_exists( public_path('img\logo\\').$config->logo ) ) 
            {
                unlink(public_path('img\logo\\').$config->logo);   
            }

            Config::destroy($id);
            
            return redirect()->route('config.index')->with([
                'flash_message' => 'Configuración eliminada con éxito',
                'flash_class'   => 'alert-success'
            ]);
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return redirect()->route('config.index')->with([
                        "flash_message" => "No se pueden eliminar un Registro Asociado con otros.",
                        "flash_class" => "alert-danger"
                    ]);
        }
    }
}
