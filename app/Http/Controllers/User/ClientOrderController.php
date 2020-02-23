<?php

namespace App\Http\Controllers\User;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientOrderController extends Controller
{
    public function index(Client $client)
    {
        $orders = $client->orders;

        return $this->showAll($orders);
    }
}
