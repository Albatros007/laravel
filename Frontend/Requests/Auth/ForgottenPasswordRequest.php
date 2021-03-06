<?php

namespace App\Frontend\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgottenPasswordRequest extends FormRequest
{
    use ValidationMesseagesTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

     /* Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }
}
