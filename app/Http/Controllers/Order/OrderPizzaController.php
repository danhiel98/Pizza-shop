<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrderPizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        $pizzas = $order->pizzas;

        return $this->showAll($pizzas);
    }
}
