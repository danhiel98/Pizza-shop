<?php

namespace App\Http\Controllers\Client;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();

        return $this->showAll($clients);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return $this->showOne($client);
    }

    /**
     * Devuelve la lista de los clientes frecuentes
     *
     * @return \Illuminate\Http\Response
     */
    public function usual()
    {
        $clients = Client::usual()->get();

        if ($clients->count() > 10) // Si son más de 10 clientes
            $clients = $clients->slice(0, 9); // Que obtenga solamente los primeros 10

        return $this->showAll($clients);
    }


    /**
     * Devuelve la lista de los clientes que más gastan
     *
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        $clients = Client::payment();

        if ($clients->count() > 10) // Si son más de 10 clientes
            $clients = $clients->slice(0, 9); // Que obtenga solamente los primeros 10

        return $this->showAll($clients);
    }
}
