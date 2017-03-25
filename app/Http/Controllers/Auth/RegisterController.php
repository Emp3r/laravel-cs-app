<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Mail\Welcome;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('confirmEmail');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['slug'] = str_slug($data['name']);

        return Validator::make($data, [
            'email' => 'required|email|unique:users',
            'name' => 'required|min:4|max:127',
            'slug' => 'unique:users|not_in:'.Lang::get('validation.forbidden_names'),
            'password' => 'required|min:6|confirmed',
        ], [
            'slug.unique' => 'Zvolte jiné jméno, později ho můžete přenastavit.',
            'slug.not_in' => 'Toto jméno je zakázané.',
            'password.required' => 'Zadejte své budoucí heslo.',
            'password.min' => 'Vaše heslo musí mít alespoň :min znaků.',
            'password.confirmed' => 'Kontrolní heslo se neshoduje s tím prvním.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'slug' => str_slug($data['name'], '-'),
            'password' => bcrypt($data['password']),
        ]);

        Mail::to($user)->send(new Welcome($user));
        flash(Lang::get('auth.registered'));

        return $user;
    }

    /**
     * Confirm a user's email address.
     *
     * @param  string $token
     * @return mixed
     */
    public function confirmEmail($token)
    {
        User::whereToken($token)->firstOrFail()->confirmEmail();
        flash(Lang::get('auth.verified'));

        return redirect('/');
    }

}
