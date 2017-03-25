<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Intervention\Image\Facades\Image;
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
        $user = Auth::user();
        $user->fill($request->all());

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            // upload avatar image
            Image::make($avatar)->resize(120, 120)->save(public_path('/img/avatars/'.$filename));
            $user->avatar = $filename;
        }
        $user->save();
        flash(Lang::get('auth.settings.user_saved'));

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateEmail(UpdateUserEmailRequest $request)
    {
        $user = Auth::user();
        $user->fill($request->all());
        $user->save();

        $user->unconfirmEmail();
        $user->sendEmailVerification();
        flash(Lang::get('auth.settings.email_saved'));

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

        $user = Auth::user();
        $user->fill($data);
        $user->save();
        flash(Lang::get('auth.settings.password_saved'));

        return redirect()->back();
    }

}
