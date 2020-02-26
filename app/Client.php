<?php

// Usuario cliente

namespace App;

use App\Scopes\ClientScope;
use App\Transformers\ClientTransformer;

class Client extends User
{
    public $transformer = ClientTransformer::class;

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ClientScope);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Devuelve la cantidad de pedidos realizados por el cliente
     *
     * @return int
     */
    public function getOrderQuantityAttribute()
    {
        return $this->orders->count();
    }

    /**
     * Devuelve el total gastado por el cliente
     *
     * @return double
     */
    public function getTotalSpendedAttribute()
    {
        $orders = $this->orders;
        $total = 0;
        foreach ($orders as $order) $total += $order->total;

        return $total;
    }

    /**
     * Clientes que han realizado más pedidos
     *
     * @param QueryBuilder $query
     * @return QueryBuilder
     */
    public function scopeUsual($query){
        return $query->whereHas('orders')->withCount('orders')->orderBy('orders_count', 'desc');
    }

    /**
     * Clientes que han gastado más dinero
     *
     * @param QueryBuiler $query
     * @return Collection
     */
    public function scopeSpended($query)
    {
        $clients = $query->whereHas('orders')->get();

        foreach ($clients as $client) {
            $orders = $client->orders()->get();

            $total = 0;
            foreach ($orders as $order) $total += $order->total;

            $client->total_spended = $total;
        }

        $sorted = $clients->sortByDesc('total_spended');
        return collect($sorted->values()->all());
    }
}
