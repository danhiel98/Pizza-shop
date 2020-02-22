<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($locale)
    {
        App::setLocale($locale); // Establece el idioma
        session()->put('locale', $locale); // Se guarda el idioma en una sesión
        return redirect()->back(); // Regresa a la página anterior
    }
}
