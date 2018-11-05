<?php
/**
 * Created by PhpStorm.
 * User: thiago
 * Date: 08/07/2018
 * Time: 13:26
 */
namespace App\Http\Controllers\Jogador;
use App\Mail\VerifyMail;
use App\Models\CardCredit;
use App\Models\Endereco;
use App\Models\Jogador;
use App\Models\OrderPedido;
use App\Models\Saldo;
use App\Models\Transacao;
use App\Models\VerifyJogador;
use App\Repositories\JogadorRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Http\Controllers\Controller;

class JogadorController extends Controller
{

    public  $repository;

    public function __construct(JogadorRepository  $repository)
    {
        $this->repository = $repository;

    }
    public function index()
    {
        return view('pages.home');
    }

    public function admin()
    {
        $users = Jogador::all();

        return view('pages.admin.listUser')->with(['users'=> $users]);
    }
    public  function criarConta(Request $request){



            $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:jogadors',
            'senha' => 'required|string|min:6',
            'accet' => 'required',
            'topic' => 'required',
            'nascimento' => 'required',
                'nickName'=>'required|unique:jogadors,username',
        ]);



        if ($validatedData->fails()) {
            return redirect('cadastro')
                ->withErrors($validatedData)
                ->withInput();
        }

        $date = explode("/", $request->input('nascimento'));
        $ano = date('Y');


        $idade = $ano - $date[2];


        if($idade < 18){
            return redirect('cadastro')->with('warning', "Você precisar ser maior de Idade")->withInput();

        }


        $user = Jogador::create([
            'name' => $name = $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('senha')),
            'username' => $request->input('nickName'),
            'nascimento' => date('Y-m-d', strtotime($date[2]."-".$date[1]."-".$date[0])),
            'code' => bcrypt($request->input('nickName'))
        ]);

        if($request->hasFile('file') && $request->file('file')->isValid())
        {
            $name =  $user->id.kebab_case($user->name);

            $extension = $request->file('file')->extension();

            $nameFile = "{$name}.{$extension}";

            $upload =  $request->file('file')->storeAs('jogadores', $nameFile, 'public');

            $user->avatar =  $nameFile;



            if(!$upload){
                return redirect()->back()->with('error', 'Falha ao enviar imagem');
            }

            $user->save();
        }

        $saldo = Saldo::create([
            'jogador_id' => $user->id,
            'saldo' => 0,
            'essencia' => 0


        ]);

        $verifyUser = VerifyJogador::create([
            'jogador_id' => $user->id,
            'token' => str_random(40)
        ]);

        Mail::to($user->email)->send(new VerifyMail($user));

        return redirect('jogador/login')->with('warning', "Verifique seu e-mail para ativar sua conta")->withInput();

    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyJogador::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
                $verifyUser->user->verified = 1;
                $verifyUser->user->save();
                $status = "Seu e-mail é verdadeiro. Agora você pode fazer o login.";
            }else{
                $status = "Seu e-mail já foi verificado. Agora você pode fazer o login.";
            }
        }else{
            return redirect('cadastro')->with('warning', "Desculpe seu e-mail não pode ser identificado.");
        }

        return redirect('jogador/login')->with('status', $status);
    }

    public function login(){
        return view('pages.login');
    }
    public function reset(){
        return view('pages.reset');
    }

    public function findUser($id){
        $jogador = Jogador::find($id);


        return view('pages.admin.editUser')->with(['user'=> $jogador]);
    }
    public function email(){
        return view('pages.email');
    }

    public function delete($id){

        $res = Jogador::where('id',$id)->delete();


        if($res){

            OrderPedido::where('jogador_id',$id)->delete();
            return redirect('admin/user')->with('success', 'Usuario apagado com sucesso');
        }
        return redirect('admin/user')->with('error', 'Error ao  apagar o usuario');

    }
    public function edit()
    {


        return view('pages.editPerfil');
    }


    public function salverUser(Request $request){

        $idUser = $request->input('idUser');
        $usercode = Jogador::where(['code' => $request->input('code')])->first();
        $jogador = Jogador::where(['id'=> $idUser])->first();

        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nascimento' => 'required',
            'code' => 'required'


        ]);
        if ($validatedData->fails()) {
            return redirect('admin/user/edit/'.$idUser)
                ->withErrors($validatedData)
                ->withInput();
        }
        $date = explode("/", $request->input('nascimento'));

       $savedUser =  $this->repository->update([
            'name' => $request->input('name'),
            'nascimento' => date('Y-m-d', strtotime($date[2]."-".$date[1]."-".$date[0])),
            'verified' => $request->input('status'),

        ], $idUser);

        if($savedUser){
            if($request->input('senha') != null){
                $savedUser =  $this->repository->update([
                    'password' => bcrypt($request->input('name')),

                ], $idUser);
            }
            if( $usercode == null){

               $saveCode =  $this->repository->update([
                    'code' => $request->input('code'),


                ], $idUser);

                if($saveCode){



                    OrderPedido::where(['code'=> $jogador->code])->update(
                        [
                            "code" => $request->input('code')
                        ]
                    );
                }

                return redirect('admin/user/edit/'.$idUser)->with('success', 'Atualização concluida com sucesso');
            }
            if($usercode->code !=  $jogador->code){
                return redirect('admin/user/edit/'.$idUser)->with('error', 'Este codigo ja existem');

            }else{
                return redirect('admin/user/edit/'.$idUser)->with('success', 'Atualização concluida com sucesso');
            }
        }



    }
    public  function listOrder($id){

        $transacoes = OrderPedido::where(['jogador_id'=> $id])->with('transacao','jogador')->get();

        return view('pages.admin.listTransacaoUser')->with(['transacoes'=> $transacoes]);
    }

    public  function store(Request $request){



        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nascimento' => 'required',

        ]);
        if ($validatedData->fails()) {
            return redirect('jogador/edit')
                ->withErrors($validatedData)
                ->withInput();
        }
        $userId  = Auth::user()->id;
        $user  = Jogador::find($userId);
        $user->name = $request->input('name');

        $date = explode("/", $request->input('nascimento'));
        $ano = date('Y');


        $idade = $ano - $date[2];


        if($idade < 18){
            return redirect('jogador/edit')->with('warning', "Você precisar ser maior de Idade")->withInput();

        }
        $filename = $user->avatar;
        $user->nascimento = date('Y-m-d', strtotime($date[2]."-".$date[1]."-".$date[0]));



        if($request->hasFile('file') && $request->file('file')->isValid())
        {
            unlink(storage_path('app/public/jogadores/'.$filename));

            $name =  $user->id.kebab_case($user->name);

            $extension = $request->file('file')->extension();

            $nameFile = "{$name}.{$extension}";

            $upload =  $request->file('file')->storeAs('jogadores', $nameFile, 'public');

            $user->avatar =  $nameFile;



            if(!$upload){
                return redirect()->back()->with('error', 'Falha ao enviar imagem');
            }

            $user->save();
            return redirect('jogador/edit')->with('success', 'Cadastro atualizado com sucesso');


        }else{
            $user->save();
            return redirect('jogador/edit')->with('success', 'Cadastro atualizado com sucesso');
        }



    }
    public function salveEndereco(Request $request){

        $validatedData = Validator::make($request->all(), [
            'endereco' => 'required',
            'cep' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',

        ]);
        if ($validatedData->fails()) {
            return redirect('jogador/endereco')
                ->withErrors($validatedData)
                ->withInput();
        }
        $endereco = Auth::user()->endereco;

        if($endereco != null){


            $endereco  = Endereco::find($endereco->id);
            $endereco->endereco = $request->input("endereco");
            $endereco->cep = $request->input("cep");
            $endereco->bairro = $request->input("bairro");
            $endereco->cidade = $request->input("cidade");
            $endereco->estado = $request->input("estado");

            $saved =  $endereco->save();

            if($saved) {
                return redirect('jogador/endereco')->with('success', 'Dados  atualizado com sucesso');;
            }else{
                return redirect('jogador/endereco')->with('error', 'Error ao atualizar dados');
            }

        }else{
            $user = Auth::user()->id;
            $userSalve = Jogador::find($user->id);

            $endereco = new Endereco([
                "cep" => $request->input("cep"),
                "endereco" => $request->input("endereco"),
                "bairro" => $request->input("bairro"),
                "cidade" => $request->input("cidade"),
                "estado" => $request->input("estado"),
            ]);

            $saved =  $userSalve->endereco()->save($endereco);

           if($saved) {
               return redirect('jogador/endereco')->with('success', 'Dados cadastrado com sucesso');;
           }else{
               return redirect('jogador/endereco')->with('error', 'Error ao cadastrar dados');
           }

        }

//        return view('pages.endereco');

    }

    public function endereco(){

        $endereco = Auth::user()->endereco;
         $enderecos = ["enderecos" => $endereco];
        return view('pages.endereco')->with($enderecos);

    }

    public function creditCard(){


        return view('pages.cadastrocartao');

    }
    public function saveCreditCard(Request $request){

        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'numero' => 'required',
            'bandeira' => 'required',
            'validacao' => 'required',
            'cvv' => 'required',
            'cpf' => 'required'

        ]);
        if ($validatedData->fails()) {
            return redirect('jogador/cadastrar-credit')
                ->withErrors($validatedData)
                ->withInput();
        }

        $name = $request->input("name");
        $numero = $request->input("numero");
        $bandeira = $request->input("bandeira");
        $validacao = $request->input("validacao");
        $cvv = $request->input("cvv");
        $cpf = $request->input("cpf");

        $card = new CardCredit([
            "name" => $name,
            "number" => $numero,
            "bandeira" => $bandeira,
            "validade" => $validacao,
            "cvv" => $cvv,
            "cpf" => $cpf,
        ]);

        $id = Auth::user()->id;
        $userSalve = Jogador::find($id);


        $saved =  $userSalve->cardCredit()->save($card);

        if($saved){
            return redirect('jogador/cadastrar-credit')->with('success', 'Dados cadastrado com sucesso');
        }
        return redirect('jogador/cadastrar-credit')->with('error', 'Error ao cadastrar dados');


    }

    public  function  recompensa(){
        $code = Auth::user()->code;
        $regaste = Auth::user()->regastes()->latest()->first();

        $statusNivel ="";

        $ultimaDte = ($regaste !=null )?$regaste->created_at->format('Y-m-d'): null;
        $dados = null;

        if($ultimaDte != null){
            $dados = OrderPedido::where(['code'=>$code])->whereHas('transacao', function ($query) use  ($ultimaDte) {
             $query->where(['status'=> 3])
                 ->where('created_at', ">", $ultimaDte);
         })->get();

        }else{
            $dados = OrderPedido::where(['code'=>$code])->whereHas('transacao', function ($query) use  ($ultimaDte) {
                $query->where(['status'=> 3]);
            })->get();
        }
       $totalIndicaçao = 0;
        $nivel = 0;
        $essencia = 0;


        if($dados != null) {


            $totalIndicacao = count($dados);


            if ($totalIndicacao != 0) {

                if($totalIndicacao <= 10){

                    if($totalIndicacao <= 2){
                        $nivel = 1;
                    }elseif($totalIndicacao <= 4){
                        $nivel = 2;
                    }elseif($totalIndicacao <= 6){
                        $nivel = 3;
                    }elseif($totalIndicacao <= 8){
                        $nivel = 4;

                    }elseif($totalIndicacao <= 10){
                        $nivel = 5;
                    }
                    $essencia = 150*$nivel;

                    $statusNivel ="BRONZE";
                }else if($totalIndicacao <= 20){

                    if($totalIndicacao <= 12){
                        $nivel = 1;
                    }elseif($totalIndicacao <= 14){
                        $nivel = 2;
                    }elseif($totalIndicacao <= 16){
                        $nivel = 3;
                    }elseif($totalIndicacao <= 18){
                        $nivel = 4;

                    }elseif($totalIndicacao <= 20){
                        $nivel = 5;
                    }
                    $essencia = 250*$nivel;
                    $statusNivel ="PRATA";
                }else if($totalIndicacao <= 30){

                    if($totalIndicacao <= 22){
                        $nivel = 1;
                    }elseif($totalIndicacao <= 24){
                        $nivel = 2;
                    }elseif($totalIndicacao <= 26){
                        $nivel = 3;
                    }elseif($totalIndicacao <= 28){
                        $nivel = 4;

                    }elseif($totalIndicacao <= 30){
                        $nivel = 5;
                    }
                    $essencia = 350*$nivel;
                    $statusNivel ="OURO";
                }else if($totalIndicacao <= 40){

                if($totalIndicacao <= 32){
                    $nivel = 1;
                }elseif($totalIndicacao <= 34){
                    $nivel = 2;
                }elseif($totalIndicacao <= 36){
                    $nivel = 3;
                }elseif($totalIndicacao <= 38){
                    $nivel = 4;

                }elseif($totalIndicacao <= 40){
                    $nivel = 5;
                }
                    $essencia = 500*$nivel;
                    $statusNivel ="PLATINA";
            }else if($totalIndicacao <= 50){

                if($totalIndicacao <= 42){
                    $nivel = 1;
                }elseif($totalIndicacao <= 44){
                    $nivel = 2;
                }elseif($totalIndicacao <= 46){
                    $nivel = 3;
                }elseif($totalIndicacao <= 48){
                    $nivel = 4;

                }elseif($totalIndicacao <= 50){
                    $nivel = 5;
                }
                    $essencia = 600*$nivel;
                    $statusNivel ="DIAMANTE";
            }else if($totalIndicacao <= 60){

                    if($totalIndicacao <= 52){
                        $nivel = 1;
                    }elseif($totalIndicacao <= 54){
                        $nivel = 2;
                    }elseif($totalIndicacao <= 56){
                        $nivel = 3;
                    }elseif($totalIndicacao <= 58){
                        $nivel = 4;

                    }elseif($totalIndicacao <= 60){
                        $nivel = 5;
                    }
                    $essencia = 800*$nivel;
                    $statusNivel ="MESTRE";

            }else if($totalIndicacao <= 70){

                    if($totalIndicacao <= 62){
                        $nivel = 1;
                    }elseif($totalIndicacao <= 64){
                        $nivel = 2;
                    }elseif($totalIndicacao <= 66){
                        $nivel = 3;
                    }elseif($totalIndicacao <= 68){
                        $nivel = 4;

                    }elseif($totalIndicacao <= 70){
                        $nivel = 5;
                    }
                    $essencia = 1000*$nivel;
                    $statusNivel ="DESAFIANTE";

                }else{
                    $nivel = 5;
                    $statusNivel ="DESAFIANTE";
                    $essencia = 1000*$nivel;
                }


            }
        }



        $nivel = ['totalIndicacao'=> $totalIndicacao, 'nivel'=> $nivel, 'essencia'=> $essencia, "statusNivel"=> $statusNivel];
//        return $totalIndicacao;


        return view('pages.recompensa')->with(['dados'=> $nivel]);

    }
    public  function  listarCartao(){

        $userId = Auth::user()->id;
        $card = CardCredit::with('jogadors')->where(["jogador_id"=> $userId])->get();


        return view("pages.listarcartao")->with(["cards"=> $card]);
    }
    public function editCard($id){
        $userId = Auth::user()->id;
        $card = CardCredit::with('jogadors')->where(["jogador_id"=> $userId, "id"=> $id])->get();
        return view('pages.editcartao')->with(["cards"=> $card]);
    }

    public function storeCard(Request $request){

        $validatedData = Validator::make($request->all(), [
            'name' => 'required',
            'numero' => 'required',
            'bandeira' => 'required',
            'validacao' => 'required',
            'cvv' => 'required',
            'cpf' => 'required'

        ]);
        $id = $request->input("id");
        if ($validatedData->fails()) {
            return redirect("jogador/edit-cartao/$id")
                ->withErrors($validatedData)
                ->withInput();
        }


        $userId = Auth::user()->id;
        $card = CardCredit::with('jogadors')->where(["jogador_id"=> $userId, "id"=> $id])->first();

        $name = $request->input("name");
        $numero = $request->input("numero");
        $bandeira = $request->input("bandeira");
        $validacao = $request->input("validacao");
        $cvv = $request->input("cvv");
        $cpf = $request->input("cpf");

        $card->name = $name;
        $card->number = $numero;
        $card->bandeira = $bandeira;
        $card->validade = $validacao;
        $card->cvv = $cvv;
        $card->cpf = $cpf;
        $saved  = $card->save();


        if($saved){
            return redirect("jogador/edit-cartao/$id")->with('success', 'Dados atualizado com sucesso');
        }

        return redirect("jogador/edit-cartao/$id")->with('error', 'Error ao atulizar dados');
    }

    public  function credit(Request $request){

        $userID =$request->input('idUser');

        $saldo = Saldo::where(["jogador_id" => $userID])->first();

        $saldo->saldo += $request->input("valor");

       $saved =  $saldo->save();

        if($saved){
            return redirect('admin/user')->with('success', 'Credito inserido com sucesso');
        }
        return redirect('admin/user')->with('error', 'Error ao inserir credito');


    }
}
