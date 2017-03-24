<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return User::where('id', $this->id)
                   ->where('id', Auth::id())->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|confirmed|unique:users,email,'.$this->id,
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'email.required' => 'E-mail je nutné vyplnit.',
            'email.email' => 'E-mailová adresa je ve špatném formátu.',
            'email.confirmed' => 'Kontrolní adresa se neshoduje s tou první.',
            'email.unique' => 'Tuto e-mailovou adresu už tu někdo používá.',
        ];
    }
}
