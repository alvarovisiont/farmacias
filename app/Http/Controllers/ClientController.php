<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Client;

class ClientController extends Controller
{
    //
    public function search_clients(Request $request)
    {
    	
    	$client = Client::where([
            ['cedula','=',$request->get('cedula')],
            ['users_id','=',Auth::user()->id]
        ])->first();

    	return response()->json($client);

    }

    public function search_clients_all()
    {
		$clients = Client::where('users_id','=',Auth::user()->id)->get();

    	return response()->json($clients);    	
    }
}
