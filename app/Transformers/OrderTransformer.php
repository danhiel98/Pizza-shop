<?php

namespace App\Transformers;

use App\Order;
use League\Fractal\TransformerAbstract;

class OrderTransformer extends TransformerAbstract
{
    /**
     * Los resultados que se muestran en la respuesta
     *
     * @return array
     */
    public function transform(Order $order)
    {
        return [
            'id'             => (int)$order->id,
            'order_number'   => (int)$order->order_number,
            'date'           => (string)$order->date,
            'pizza_quantity' => (integer)$order->pizza_quantity,
            'total'          => (double)$order->total,
            'created_at'     => (string)$order->created_at,
            'client'         => [
                'id'    => (int)$order->client->id,
                'name'  => (string)$order->client->name,
                'email' => (string)$order->client->email
            ]
        ];
    }
}
