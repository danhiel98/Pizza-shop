<?php

use App\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::truncate();

        $orders = [
            [
                'client_id'    => 2,
                'order_number' => 1,
            ],
            [
                'client_id'    => 3,
                'order_number' => 2,
            ],
            [
                'client_id'    => 2,
                'order_number' => 3,
            ],
            [
                'client_id'    => 2,
                'order_number' => 4,
            ],
            [
                'client_id'    => 3,
                'order_number' => 5,
            ],
        ];

        foreach ($orders as $order) Order::create($order);
    }
}
