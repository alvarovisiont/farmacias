<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\DetailSale;
use App\Stocktaking;
use App\Sale;
use App\Buy;
use App\User;

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
        $sale = Sale::count();
        $buy  = Buy::count();
        $stock = Stocktaking::count();
        $mes_actual = date('m');
        $año_actual = date('Y');

        $users = User::where('nivel','>',1)->get()->count();

        $sql = "SUM(quantity) as total, (SELECT product from stocktakings where products_id = id) as product";

        $total_medicinas = DB::table('detail_sales')->selectRaw($sql)->whereRaw(" MONTH(created_at) = $mes_actual and YEAR(created_at) = $año_actual ")->groupBy('product')->limit(3)->get();

        $sql = "SELECT * from ( 
                    SELECT COUNT(sales.id) as total, sales.clients_id, c.* FROM `sales` 
                    INNER JOIN clients as c ON c.id = sales.clients_id 
                    GROUP BY clients_id, c.id,c.users_id,c.number, c.cedula,c.name_complete, c.email,c.gender,c.address,c.created_at,c.updated_at 
                ) as tt ORDER BY tt.total DESC LIMIT 10";

        $max_buyers = DB::select($sql);

        $alert_products = Stocktaking::where('quantity','<=', 50)->get();

        $datos = ['sale' => $sale, 'buy' => $buy, 'stock' => $stock,'total_medicinas' => $total_medicinas, 'alert_products' => $alert_products,'max_buyers' => $max_buyers, 'users' => $users];

        return view('home.home_admin')->with($datos);
    }

    public function index_farmacia()
    {
        $mes_actual = date('m');
        $año_actual = date('Y');

        $sale = Sale::where('users_id','=',Auth::user()->id)->count();
        $buy  = Buy::where('user_id','=',Auth::user()->id)->count();
        $stock = Stocktaking::where('users_id','=',Auth::user()->id)->count();

        $sql = "SELECT * from ( 
                    SELECT COUNT(sales.id) as total, sales.clients_id, c.* FROM `sales` 
                    INNER JOIN clients as c ON c.id = sales.clients_id 
                    WHERE sales.users_id = ".Auth::user()->id."
                    GROUP BY clients_id, c.id,c.users_id,c.number, c.cedula,c.name_complete, c.email,c.gender,c.address,c.created_at,c.updated_at 
                ) as tt ORDER BY tt.total DESC LIMIT 10";

        $max_buyers = DB::select($sql);

        $sql1 = "SUM(quantity) as total, (SELECT product from stocktakings where products_id = id) as product";

        $total_medicinas = DetailSale::join('sales','sales.id','=','detail_sales.sales_id')
                                    ->selectRaw($sql1)
                                    ->whereRaw("MONTH(detail_sales.created_at) = $mes_actual and YEAR(detail_sales.created_at) = $año_actual and sales.users_id = ".Auth::user()->id)
                                    ->groupBy('product')->limit(3)->get();

        $alert_products = Stocktaking::where([
            ['quantity','<=', 50],
            ['users_id','=',Auth::user()->id]
        ])->get();


        $datos = ['sale' => $sale, 'buy' => $buy, 'stock' => $stock, 'total_medicinas' => $total_medicinas, 'alert_products' => $alert_products, 'max_buyers' => $max_buyers];

        return view('home.home')->with($datos);
    }
}
