<?php 

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Myth\Auth\Config\Auth as AuthConfig;

class Auth extends AuthConfig
{

    # VIEW
    public $views = [
        // 'login'         => 'Myth\Auth\Views\login',
        'login'        => '\App\Views\auth\login',
        'register'      => 'Myth\Auth\Views\register',
        'forgot'          => 'Myth\Auth\Views\forgot',
        'reset'        => 'Myth\Auth\Views\reset',
        'emailForgot'    => 'Myth\Auth\Views\emails\forgot',
        'emailActivation' => 'Myth\Auth\Views\emails\activation',
    ];

    # AKTIVASI AKUN VIA EMAIL
    // public $requireActivation = 'Myth\Auth\Authentication\Activators\EmailActivator';
    public $requireActivation = false;

    public $allowRegistration = false;

    public $allowRemembering = true;

    public $activeResetter = null;
    // public $activeResetter = 'Myth\Auth\Authentication\Resetters\EmailResetter';

    public $rememberLength = 30 * DAY;

}