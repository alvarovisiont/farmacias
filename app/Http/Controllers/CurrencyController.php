<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ConfigCurrency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $currency = ConfigCurrency::where('users_id','=',Auth::user()->id)->get();

        return view('config_currency.index')->with('currency',$currency);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $currency = new ConfigCurrency;
        $ruta = "/config_currency";
        $datos = ['currency' => $currency, 'ruta' => $ruta, 'edit' => false];
        return view('config_currency.create')->with($datos);
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
        $currency = new ConfigCurrency;
        $currency->fill($request->all());
        $currency->users_id = Auth::user()->id;
        $currency->save();

        return redirect()->route('config_currency.index')->with([
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
        $currency = ConfigCurrency::findOrFail($id);
        $ruta = "/config_currency/".$id;
        $datos = ['currency' => $currency, 'ruta' => $ruta, 'edit' => true];
        return view('config_currency.create')->with($datos);
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
        $currency = ConfigCurrency::findOrFail($id);
        $currency->fill($request->all());
        $currency->users_id = Auth::user()->id;
        $currency->save();

        return redirect()->route('config_currency.index')->with([
            'flash_message' => "Registro guardado con éxito",
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

            ConfigCurrency::destroy($id);
            
            return redirect()->route('config_currency.index')->with([
                'flash_message' => 'Registro eliminado con éxito',
                'flash_class'   => 'alert-success'
            ]);
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            return redirect()->route('config_currency.index')->with([
                        "flash_message" => "No se pueden eliminar un Registro Asociado con otros.",
                        "flash_class" => "alert-danger"
                    ]);
        }
    }
}
