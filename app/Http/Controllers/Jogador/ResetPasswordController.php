<?php

namespace App\Http\Controllers\Jogador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;


class ResetPasswordController extends Controller
{
    //
    use ResetsPasswords;

    //Show form to seller where they can reset password
    public function showResetForm(Request $request, $token = null)
    {
        return view('pages.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    public function broker()
    {
        return Password::broker('jogador');
    }

    //returns authentication guard of seller
    protected function guard()
    {
        return Auth::guard('jogador');
    }
}
