<?php

use App\OrderDetail;
use Illuminate\Database\Seeder;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderDetail::truncate();

        $orderDetails = [
            [
                'order_id'       => 1,
                'pizza_id'       => 1,
                'pizza_quantity' => 2
            ],
            [
                'order_id'       => 1,
                'pizza_id'       => 2,
                'pizza_quantity' => 1
            ],
            [
                'order_id'       => 2,
                'pizza_id'       => 3,
                'pizza_quantity' => 1
            ],
            [
                'order_id'       => 3,
                'pizza_id'       => 1,
                'pizza_quantity' => 1
            ],
            [
                'order_id'       => 3,
                'pizza_id'       => 3,
                'pizza_quantity' => 1
            ],
            [
                'order_id'       => 4,
                'pizza_id'       => 1,
                'pizza_quantity' => 1
            ],
            [
                'order_id'       => 4,
                'pizza_id'       => 2,
                'pizza_quantity' => 2
            ],
            [
                'order_id'       => 4,
                'pizza_id'       => 3,
                'pizza_quantity' => 1
            ],
            [
                'order_id'       => 5,
                'pizza_id'       => 2,
                'pizza_quantity' => 3
            ],
        ];

        foreach ($orderDetails as $detail) OrderDetail::create($detail);
    }
}
