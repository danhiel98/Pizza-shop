<?php

namespace App\Transformers;

use App\Client;
use League\Fractal\TransformerAbstract;

class ClientTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Client $client)
    {
        return [
            'id'             => (int)$client->id,
            'name'           => (string)$client->name,
            'email'          => (string)$client->email,
            'order_quantity' => (int)$client->order_quantity,
            'total_spended'  => (double)number_format($client->total_spended, 2),
            'is_active'      => $client->isActive(),
            'created_at'     => (string)$client->created_at
        ];
    }
}
