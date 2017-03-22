<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Create a new UsersController instance and set middlewares.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display a profile page of the specified user.
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the logged user.
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}
