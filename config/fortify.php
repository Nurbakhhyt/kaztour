<?php

use Laravel\Fortify\Features;

return [

    'guard' => 'web',

    'passwords' => 'users',

    'username' => 'email',

    'email' => 'email',

    'lowercase_usernames' => true,

    'home' => '/home', // Измени, если нужно другое перенаправление

    'prefix' => '',

    'domain' => null,

    'middleware' => ['web'],

    'limiters' => [
        'login' => 'login',
        'two-factor' => 'two-factor',
    ],

    'views' => true, // Если API, можно отключить (false)

    'features' => [
        Features::registration(), // Включает регистрацию пользователей
        Features::resetPasswords(), // Позволяет сбрасывать пароль
        Features::emailVerification(), // Если нужна верификация e-mail, раскомментируй
        Features::updateProfileInformation(), // Обновление данных пользователя
        Features::updatePasswords(), // Обновление пароля
        Features::twoFactorAuthentication([
            'confirm' => true,
            'confirmPassword' => true,
        ]),
    ],

];
