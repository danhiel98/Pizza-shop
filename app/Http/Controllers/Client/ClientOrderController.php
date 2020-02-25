<?php

namespace App\Http\Controllers\Client;

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
}
