<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\DetailSale;
use App\Stocktaking;
use App\Sale;
use App\Buy;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_admin()
    {
        return view('home.home_admin');
    }

    public function index_farmacia()
    {
        $mes_actual = date('m');
        $año_actual = date('Y');

        $sale = Sale::where('users_id','=',Auth::user()->id)->count();
        $buy  = Buy::where('user_id','=',Auth::user()->id)->count();
        $stock = Stocktaking::where('users_id','=',Auth::user()->id)->count();

        $sql = "SUM(total) as total_sale, (SELECT SUM(total) as total from buys) as total_spend";
        
        $total_balance = DB::table('sales')->selectRaw($sql)->whereRaw("MONTH(created_at) = 12 and YEAR(created_at) = 2017")->get();

        $sql = "SUM(quantity) as total, (SELECT product from stocktakings where products_id = id) as product";

        $total_medicinas = DB::table('detail_sales')->selectRaw($sql)->whereRaw("MONTH(created_at) = 12 and YEAR(created_at) = 2017")->groupBy('product')->limit(3)->get();

        $alert_products = Stocktaking::where('quantity','<=', 50)->get();


        $datos = ['sale' => $sale, 'buy' => $buy, 'stock' => $stock, 'total_balance' => $total_balance, 'total_medicinas' => $total_medicinas, 'alert_products' => $alert_products];

        return view('home.home')->with($datos);
    }
}
