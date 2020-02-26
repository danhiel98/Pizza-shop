<?php

namespace App\Http\Controllers\Administrator;

use App\Administrator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrators = Administrator::all();

        return $this->showAll($administrators);
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
            'name'  => 'required|min:5',
            'email' => 'required|email|unique:users,email'
        ];

        $this->validate($request, $rules);

        $fields = $request->only([
            'name', 'email'
        ]);

        $fields['password'] = bcrypt('secret');
        $fields['type'] = Administrator::NORMAL_USER;

        $administrator = Administrator::firstOrCreate($fields);

        $code = $administrator->wasRecentlyCreated ? 201 : 200;

        return $this->showOne($administrator, $code);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function show(Administrator $administrator)
    {
        return $this->showOne($administrator);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrator $administrator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrator $administrator)
    {
        //
    }

    /**
     * Restablece la contraseña del usuario a 'secret'
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request, Administrator $administrator)
    {
        $administrator->password = bcrypt('secret');

        $administrator->save();

        return $this->showOne($administrator);
    }

    /**
     * Desactiva el usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request, Administrator $administrator)
    {
        $administrator->is_active = Administrator::USER_NO_ACTIVE;

        $administrator->save();

        return $this->showOne($administrator);
    }

    /**
     * Activa el usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function enable(Request $request, Administrator $administrator)
    {
        $administrator->is_active = Administrator::USER_ACTIVE;

        $administrator->save();

        return $this->showOne($administrator);
    }
}
