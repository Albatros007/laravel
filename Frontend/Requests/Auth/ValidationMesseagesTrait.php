<?php


namespace App\Frontend\Requests\Auth;


trait ValidationMesseagesTrait
{
    public static $rulesParams = [
        'loginMin' => 5,
        'loginMax' => 15,
        'passMin' => 3
    ];

    public function messages()
    {
        return [
            'name.required' => 'Поле "Логин" обязательно к заполнению',
            'name.unique' => 'Этот логин уже занят',
            'name.min' => 'Логин дожен содержать от ' . self::$rulesParams['loginMin'] . ' до ' . self::$rulesParams['loginMax'] . ' символов',
            'name.max' => 'Логин дожен содержать от ' . self::$rulesParams['loginMin'] . ' до ' . self::$rulesParams['loginMax'] . ' символов',

            'email.required' => 'Поле "E-mail" обязательно к заполнению',
            'email.email' => '"E-mail" должен быть правильным e-mail адресом',
            'email.unique' => 'Этот e-mail адрес уже занят',

            'password.required' => 'Поле "Пароль" обязательно к заполнению',
            'password.min' => 'Пароль должен содержать не менее ' . self::$rulesParams['passMin'] . ' символов',
            'password.confirmed' => 'Введенные пароли не совпадают',

            'g-recaptcha-response.required' => 'Вы не поставили галку "Я не робот"',
            'g-recaptcha-response.captcha' => 'Не верная каптча',
        ];
    }
}
