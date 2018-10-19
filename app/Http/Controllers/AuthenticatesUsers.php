<?php
namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\RedirectResponse as Redirection;
use App\Http\Requests\AuthRequest as Request;

trait AuthenticatesUsers
{
    public function __construct()
    {
        $this->middleware("guest:$this->guard", ['except' => 'logout']);
    }
    public function login(Request $request, Auth $auth)
    {


        $authorized = $auth->guard($this->guard)->attempt($request->only('email', 'password'));


          if ($authorized) {

              if($auth->user()->verified == 0){

                  $auth->guard($this->guard)->logout();

                 return redirect('/jogador/login')->with('warning', "Verifique seu e-mail para ativar sua conta")->withInput();
              }

            return redirect()->intended($this->redirectTo);
        }

        return redirect('/jogador/login')
            ->with('authError', 'Email ou senha incorretos.')
            ->withInput($request->except('password'));
    }
    public function logout(Auth $auth)
    {
        $auth->guard($this->guard)->logout();
        return redirect('/');
    }
    public  function create(Request $request, Auth $auth){
        return "fui chamdo";
    }
}