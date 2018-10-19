<?php

namespace App\Http\Controllers\Jogador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

//Trait
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    //
    use SendsPasswordResetEmails;

    //Shows form to request password reset
    public function showLinkRequestForm()
    {
        return view('pages.email');
    }

    //Password Broker for Seller Model
    public function broker()
    {
        return Password::broker('jogador');
    }
}
