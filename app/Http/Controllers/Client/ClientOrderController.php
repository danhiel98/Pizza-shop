<?php

namespace App\Http\Controllers\Client;

use App\Order;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientOrderController extends Controller
{
    /**
     * Devuelve los pedidos según el cliente
     *
     * @param Client $client
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
        $orders = $client->orders;

        return $this->showAll($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Client $client)
    {
        $fields['client_id'] = $client->id;
        $fields['order_number'] = Order::orderBy('id')->get()->last()->order_number + 1;

        $order = Order::firstOrCreate($fields);

        $code = $order->wasRecentlyCreated ? 201 : 200;

        return $this->showOne($order, $code);
    }
}
