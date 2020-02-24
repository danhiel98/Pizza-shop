<?php

namespace App\Http\Controllers\User;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderDetail;

class ClientOrderController extends Controller
{
    public function index(Client $client)
    {
        $orders = $client->orders;

        $i = 0;
        foreach ($orders as $order) {;
            $order->pizza_quantity = $order->orderDetails()->get()->pluck('pizza_quantity')->sum();

            $total = 0;
            $details = $order->pizzas()->with('pizzaDetails')->get()->pluck('pizzaDetails')->collapse();

            foreach ($details as $detail) $total += $detail->ingredient_price * $detail->ingredient_quantity;

            $order->total = number_format($total, 2);
        }

        return $this->showAll($orders);
    }
}
