<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['orderNumber', 'config']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userType = Auth::user()->type;

        if ($userType == User::NORMAL_USER)
            return view('admin.dashboard');
        else
            return view('client.dashboard');
    }

    /**
     * Carga vista para generar nuevo pedido
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function new()
    {
        if (Auth::user()->type == User::NORMAL_USER) return view('home');

        return view('client.new-order');
    }

    public function users()
    {
        if (Auth::user()->type == User::CLIENT_USER) return view('home');

        return view('admin.users');
    }

    /**
     * Develve el último pedido ingresado
     *
     * @return Order
     */
    public function orderNumber()
    {
        $order = Order::orderBy('id')->get()->last();

        return $this->showOne($order);
    }

    /**
     * Devuelve los datos de configuración del sistema
     *
     * @return Collection
     */
    public function config()
    {
        $configs = Config::all()->first();

        return $this->showOne($configs);
    }
}
