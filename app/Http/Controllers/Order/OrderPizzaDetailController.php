<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderDetail;
use App\Pizza;
use Illuminate\Http\Request;

class OrderPizzaDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order, Pizza $pizza)
    {
        $rules = [ 'pizza_quantity' => 'min:0' ]; // Reglas de validación

        $this->validate($request, $rules);

        $fields['pizza_quantity'] = $request->pizza_quantity;
        $fields['order_id']       = $order->id;
        $fields['pizza_id']       = $pizza->id;

        $orderDetail = OrderDetail::firstOrCreate($fields);

        $code = $orderDetail->wasRecentlyCreated ? 201 : 200;

        return $this->showOne($orderDetail, $code);
    }
}
