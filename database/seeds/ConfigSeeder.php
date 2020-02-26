<?php

use App\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::truncate();

        Config::create([
            'business_name'    => 'The Pizza Shop',
            'pizza_base_price' => 2.5
        ]);
    }
}
