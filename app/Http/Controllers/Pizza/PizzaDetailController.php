<?php

namespace App\Http\Controllers\Pizza;

use App\Http\Controllers\Controller;
use App\Pizza;
use Illuminate\Http\Request;

class PizzaDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pizza $pizza)
    {
        $pizzaDetails = $pizza->pizzaDetails;

        return $this->showAll($pizzaDetails);
    }
}
