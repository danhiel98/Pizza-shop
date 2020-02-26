<?php

namespace App\Transformers;

use App\Config;
use League\Fractal\TransformerAbstract;

class DefaultTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Config $config)
    {
        return [
            'id'               => (int)$config->id,
            'business_name'    => (string)$config->business_name,
            'pizza_base_price' => (double)$config->pizza_base_price,
            'created_at'       => (string)$config->created_at
        ];
    }
}
