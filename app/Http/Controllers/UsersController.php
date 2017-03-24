<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateUserEmailRequest;
use App\Http\Requests\UpdateUserPasswordRequest;

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
        return view('user.edit')->with('user', Auth::user());
    }

    /**
     * Show the email change form for the logged user.
     * @return \Illuminate\Http\Response
     */
    public function editEmail()
    {
        return view('user.edit-email')->with('user', Auth::user());
    }

    /**
     * Show the password change form for the logged user.
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        return view('user.edit-password')->with('user', Auth::user());
    }


    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        $this->fillUser($request->all());
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEmail(UpdateUserEmailRequest $request)
    {
        $this->fillUser($request->all(), true);
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdateUserPasswordRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->newpassword);

        $this->fillUser($data);
        return redirect()->back();
    }


    private function fillUser($requestArray, $resetEmail = false)
    {
        $user = User::findOrFail($requestArray['id']);
        $user->fill($requestArray);
        $user->save();

        if ($resetEmail) {
            $user->unconfirmEmail();
            $user->sendEmailVerification();
        }
    }

}
