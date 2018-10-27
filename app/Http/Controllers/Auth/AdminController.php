<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    //

    public function index(){
       if (auth()->guard('admin')){
           return view('pages.admin.dashboard');
       }else{
           redirect('admin/login')->with(['error'=> "Você não esta logado"]);
       }

    }
    public function rifas(){
        return view('pages.admin.rifas');
    }

    public function login(){
        return view('pages.admin.login');
    }

    public function sendLogin(Request $request){

        $validatedData = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required',

        ]);





        if ($validatedData->fails()) {
            return redirect('admin/login')
                ->withErrors($validatedData)
                ->withInput();
        }

        $crendencia = ['email' => $request->input('email'), 'password' => $request->input('password')];

        $authorized = auth()->guard('admin')->attempt($crendencia);

        if($authorized){

            if(auth()->guard('admin')->user()->verified == 0){

                auth()->guard("admin")->logout();

                return redirect('admin/login')->with('warning', "Seu login esta desativado")->withInput();
            }

            return redirect("admin/dashboard");

        }else{

            return  redirect("admin/login")
                ->withErrors(['erros'=> "Login ou senha inválido"])
                ->withInput();
        }
    }
    public function logout(){

        auth()->guard('admin')->logout();
        return redirect('admin/login');
    }

}
