<?php

namespace App\Http\Controllers\Pizza;

use App\Config;
use App\Http\Controllers\Controller;
use App\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pizzas = request()->has('q') ? Pizza::search(request()->q)->get() : Pizza::all();

        return $this->showAll($pizzas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'min:5|max:50'
        ];

        $this->validate($request, $rules);

        $fields['name']       = $request->name;
        $fields['base_price'] = Config::all()->first()->pizza_base_price;

        $pizza = Pizza::firstOrCreate($fields);

        $code = $pizza->wasRecentlyCreated ? 201 : 200;

        return $this->showOne($pizza, $code);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function show(Pizza $pizza)
    {
        return $this->showOne($pizza);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pizza $pizza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pizza $pizza)
    {
        //
    }
}
