<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::all();

        return view('pages.admin.listAdmin')->with(["users"=> $users]);
    }

    public function create(){
        return view('pages.admin.createAdmin');
    }
    public function store(Request $request){

        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'senha' => 'required|string|min:6',

        ]);

        if ($validatedData->fails()) {
            return redirect('admin/administradores/create')
                ->withErrors($validatedData)
                ->withInput();
        }

        $salved = User::create([
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "password" => bcrypt($request->input('senha')),
            "verified" => $request->input('status')
        ]);

        if($salved){

            return redirect('admin/administradores/create')->with('success', "Conta criada com sucesso");
        }

        return redirect('admin/administradores/create')->with('error', 'Error ao salvar dados');
    }

    public function edit($id){

        $users = User::find($id);

        return view('pages.admin.editAdmin')->with(["user" => $users]);

    }

    public function udpate(Request $request){
        $id = $request->input("id");
        $name = $request->input("name");
        $status = $request->input("status");
        $senha = $request->input("senha");

        $users = User::find($id);

        if($senha == null){
           $saved =  $users->update([
                "name"=> $name,
                "verified"=> $status
            ]);
        }else{
            $saved =  $users->update([
                "name"=> $name,
                "verified"=> $status,
                "password"=> $senha,
            ]);
        }
        if($saved){

            return redirect('admin/administradores/edit/'.$id)->with('success', "Dados Atualizado com sucesso");
        }

        return redirect('admin/administradores/edit/'.$id)->with('error', 'Error ao atualizar dados');
    }

    public  function imagem($id){
        $users = User::find($id);

        return view('pages.admin.imageadmin')->with(["user" => $users]);

    }

    public function updateImagem(Request $request,$id){
        if($request->hasFile('file') && $request->file('file')->isValid())
        {
            $data = User::find($id);

            if($data->avatar != null){

                unlink(public_path('assets/imagem/admin/'.$data->avatar));
            }



            $name =  $data->id.kebab_case($data->name);

            $extension = $request->file('file')->extension();

            $nameFile = "{$name}.{$extension}";

            $upload =  $request->file('file')->move(public_path('assets/imagem/admin/'), $nameFile);

            $data->avatar =  $nameFile;


            $data->save();

            return response()->json($data);
        }
    }
}
