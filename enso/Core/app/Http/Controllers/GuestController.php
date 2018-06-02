<?php

namespace LaravelEnso\Core\app\Http\Controllers;

use App\Http\Controllers\Controller;

class GuestController extends Controller
{
    public function __invoke()
    {
        return [
            'meta' => $this->meta(),
            'i18n' => $this->i18n(),
        ];
    }

    private function meta()
    {
        return [
            'appName' => config('app.name'),
            'logo' => config('app.logo', 'images/logo.png'),
        ];
    }

    private function i18n()
    {
        return [
            app()->getLocale() => [
                'Email' => __('Email'),
                'Password' => __('Senha'),
                'Remember me' => __('Lembrar-me'),
                'Forgot password' => __('Esqueceu a Senha'),
                'Login' => __('Login'),
                'Send a reset passworkd link' => __('Enviar o link de troca de senha'),
                'Repeat Password' => __('Repetir Senha'),
                'Success' => __('Sucesso'),
                'Error' => __('Erro'),
            ],
        ];
    }
}
