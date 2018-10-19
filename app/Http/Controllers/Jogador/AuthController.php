<?php

/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 08/07/2018
 * Time: 12:57
 */
namespace App\Http\Controllers\Jogador;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthenticatesUsers;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'jogador';
    protected $redirectTo = '/';

    public function index()
    {
        return view('customers.auth');
    }
}