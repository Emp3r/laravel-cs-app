<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateUserPasswordRequest extends FormRequest
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
            'password' => 'required',
            'newpassword' => 'required|min:6|confirmed',
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
            'password.required' => 'Současné heslo je nutné vyplnit.',
            'newpassword.required' => 'Nové heslo je nutné vyplnit.',
            'newpassword.min' => 'Heslo musí mít alespoň :min znaků.',
            'newpassword.confirmed' => 'Kontrolní heslo se neshoduje s tím prvním.',
        ];
    }


    protected function formatErrors(Validator $validator)
    {
        $pw = User::where('id', $this->id)->where('id', Auth::id())->first()->password;

        if (! Hash::check($this->password, $pw))
            $validator->errors()->add('password', 'Zadali jste špatné heslo.');

        return $validator->getMessageBag()->toArray();
    }
}
