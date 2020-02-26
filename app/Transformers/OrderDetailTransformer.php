<?php

namespace App\Transformers;

use App\OrderDetail;
use League\Fractal\TransformerAbstract;

class OrderDetailTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(OrderDetail $orderDetail)
    {
        return [
            'id'             => (int)$orderDetail->id,
            'pizza_price'    => (double)number_format($orderDetail->pizza_price, 2),
            'pizza_quantity' => (int)$orderDetail->pizza_quantity,
            'total'          => (double)number_format($orderDetail->total, 2),
            'pizza'          => [
                'id'                => (int)$orderDetail->pizza->id,
                'name'              => (string)$orderDetail->pizza->name,
                'base_price'        => (double)$orderDetail->pizza->base_price,
                'ingredients_price' => (double)number_format($orderDetail->pizza->ingredients_price, 2),
                'total'             => (double)number_format($orderDetail->pizza->price, 2),
            ],
            'order'          => [
                'id'             => (int)$orderDetail->order->id,
                'order_number'   => (int)$orderDetail->order->order_number,
                'client_id'      => (int)$orderDetail->order->client_id,
                'pizza_quantity' => (integer)$orderDetail->order->pizza_quantity,
                'total'          => (double)number_format($orderDetail->order->total, 2),
            ]
        ];
    }
}
