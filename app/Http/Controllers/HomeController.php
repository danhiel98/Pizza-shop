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

    public function new()
    {
        if (Auth::user()->type == User::NORMAL_USER) return view('home');

        return view('client.new-order');
    }

    public function orderNumber()
    {
        $order = Order::orderBy('id')->get()->last();

        return $this->showOne($order);
    }

    public function config()
    {
        $configs = Config::all()->first();

        return $this->showOne($configs);
    }
}
