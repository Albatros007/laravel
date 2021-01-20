<?php

namespace App\Frontend\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:'.self::$rulesParams['loginMin'].'|max:'.self::$rulesParams['loginMax'].'|unique:'.User::getTableName().',name',
            'email' => 'required|email|unique:'.User::getTableName().',email',
            'password' => 'required|min:'.self::$rulesParams['passMin'].'|confirmed',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }
}
