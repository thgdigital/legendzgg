<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Item;
use App\Models\Jogador;
use App\Models\Rifa;
use App\Models\TipoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Item::all();

        return view('pages.admin.listitems')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tipos = TipoItem::all();
        return view('pages.admin.cadItems')->with('tipos', $tipos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $iduser = Auth::user()->id;
        $idRifa = $request->input("id_rifa");
        $numero_rifa = $request->input("id_numero");
        $valor_Total = $request->input('valor_Total');

        $date = date('Y-m-d H:i:s');
        $ids = explode(',', $request->input('id_numero'));

       if(is_array($ids)){

           foreach ($ids as &$value) {
               DB::table('items_jogador')->insert(
                    ['items_id' => $idRifa, 'jogador_id' => $iduser, 'numeber'=>$value, 'created_at'=>$date, 'updated_at'=>$date,]
                );
           }
       }else{
           DB::table('items_jogador')->insert(
               ['items_id' => $idRifa, 'jogador_id' => $iduser, 'numeber'=>$numero_rifa, 'created_at'=>$date, 'updated_at'=>$date,]
           );
       }

        $user = Auth::user();
        $user->saldo->saldo = $user->saldo->saldo - $valor_Total;
        $user->saldo->save();



    }

    public function salvarItems(Request $request)
    {
        $validatedData = Validator::make($request->all(), [

            'name' => 'required',
            'number' => 'required',
            'slug' => 'required',
            'valor_rifa' => 'required',
            'valor_rp' => 'required',
            'valor_venda' => 'required',
            'tipo' => 'required'

        ]);
//
        if ($validatedData->fails()) {
            return response()->json(["status"=> false, "message"=> "Existem campos em branco"]);
        }



        $saved = Item::create([

            'name' => $request->input('name'),
            'num_rifias' => $request->input('number'),
            'resgatavel' => $request->input('resgatavel') == true ? 1: 0 ,
            'slug' => $request->input('slug'),
            'status' => $request->input('ativo') == true ? 1: 0 ,
            'valor_rifa' => $request->input('valor_rifa'),
            'valor_rp' => $request->input('valor_rp'),
            'valor_venda' => $request->input('valor_venda'),
            'valor_essencia' => $request->input('valor_essencia'),
            'valor_credito' => $request->input('valor_credito'),
            'tipo_items_id' => $request->input('tipo'),

        ]);

        if($saved){
            return response()->json(["status"=> true, "message"=> "Dados salvos com sucesso"]);
        }
        return response()->json(["status"=> false, "message"=> "Error ao salvar dados"]);


    }
    public function editNumber($id){

        $user = DB::table('items_jogador')->where('id', $id)->orderBy('numeber', 'asc')->first();

        return view('pages.admin.editNumber')->with('numbes', $user);
    }

    public function formEditNumber(Request $request){

        $where = ['id'=> $request->input('itemId')];
        $item = Item::where($where)->first();
        $numero = $request->input('number');
        $id = $request->input('numberId');
        $jogador = $request->input('numberId');


        if($numero <= $item->num_rifias){
            $wr = ['numeber'=> $numero];
            $user = DB::table('items_jogador')->where($wr)->orderBy('numeber', 'asc')->first();



            if(!empty($user)){
                if($user->jogador_id == $jogador){
                    return redirect('admin/items/edit-number/'.$id)->with('success', 'Dados alterado com sucesso');

                }else{
                    return redirect('admin/items/edit-number/'.$id)->with('error', 'Esse bilhete ja esta escolhido');
                }
            }else{
                DB::table('items_jogador')->where('id', $id)->update(['numeber' => $numero]);
                return redirect('admin/items/edit-number/'.$id)->with('success', 'Dados alterado com sucesso');
            }

        }
        return redirect('admin/items/edit-number/'.$id)->with('error', 'Este numero não esta entre 1 e '.$item->num_rifias);


    }

    public function deleteNumber($id){
        $wr = ['id'=> $id];
        $user = DB::table('items_jogador')->where($wr)->orderBy('numeber', 'asc')->first();
       $saved =  DB::table('items_jogador')->where('id', '=', $id)->delete();
        if($saved){
            return redirect('admin/items/number/'.$user->items_id)->with('success', 'Dados excluido com sucesso');
        }
        return redirect('admin/items/number/'.$user->items_id)->with('error', 'Error ao excluir bilhete');
    }

    public function salvar(Request $request)
    {

//        $validatedData = Validator::make($request->all(), [
//            'ativo' => 'required',
//            'name' => 'required',
//            'number' => 'required',
//            'resgatavel' => 'required',
//            'slug' => 'required',
//            'ativado' => 'required',
//            'valor_rifa' => 'required',
//            'valor_rp' => 'required',
//            'valor_venda' => 'required'
//
//        ]);
////
//        if ($validatedData->fails()) {
//            return response()->json($validatedData->fails());
//        }

        $id = $request->input('id');

        $item = Item::find($id);
        $status = $item->update([

            'name' => $request->input('name'),
            'number' => $request->input('number'),
            'resgatavel' => $request->input('resgatavel') == true ? 1: 0 ,
            'slug' => $request->input('slug'),
            'status' => $request->input('ativo') == true ? 1: 0 ,
            'valor_rifa' => $request->input('valor_rifa'),
            'valor_rp' => $request->input('valor_rp'),
            'valor_venda' => $request->input('valor_venda'),
            'valor_essencia' => $request->input('valor_essencia'),
            'valor_credito' => $request->input('valor_credito'),
            'tipo_items_id' => $request->input('tipo'),
        ]);



        if($status){
            $item->valor_essencia = $request->input('valor_essencia');
            $item->valor_credito = $request->input('valor_credito');

        }

        $saved = $item->save();


        return ["status"=> $saved];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($categoria, $item)

    {


        $where = ['name'=> $categoria];
        $rifa = Rifa::where($where)->with(['items' => function ($query) use  ($item) {
            $query->where('status', 1);
            $query->where('slug', $item);

        }])->first();
        $user = null;
        $items = null;
        $jogador = null;


        if (count($rifa->items) > 0){
            $items = $rifa->items->first();
            $user = DB::table('items_jogador')->where('items_id', $items->id)->orderBy('numeber', 'asc')->get();
        }
        $item = Item::with('jogadors')->where('id',$items->id)->first();


        if($rifa->is_fechada == 0 && $item->num_rifias == $item->jogadors->count()){
            $rifa->is_fechada = 1;


            $array = [];
            foreach($user as $number){
                $array[] = $number->numeber;
            }
            $random = array_random($array);
            $rifa->sorteio = $random;
            $rifa->save();

            $itemsJogo = DB::table('items_jogador')->where('numeber', $random)->orderBy('numeber', 'asc')->first();
            $jogador = Jogador::find($itemsJogo->jogador_id);

            $inventario = new Inventario([
                'send' => 1,
                'is_liberado' => 0,
                'jogador_id'=> $jogador->id

            ]);


        }
        


        if($rifa->is_fechada == 1){

            $itemsJogo = DB::table('items_jogador')->where('numeber', $rifa->sorteio)->orderBy('numeber', 'asc')->first();
            $jogador = Jogador::find($itemsJogo->jogador_id);
        }

        $width = ['item' => $items, 'users'=> $user,'rifa'=> $rifa, 'jogador'=> $jogador ];

        return view('pages.items')->with($width);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $items = Item::with('rifas')->where(['id'=> $id])->first();

         $items->rifas[0]->name = str_slug($items->rifas[0]->name);

        return view('pages.admin.edititems')->with('items', $items);
    }

    public function number($id)
    {
        $items = Item::with('jogadors')->where(['id'=> $id])->first();

        return view('pages.admin.listNumberItems')->with('items', $items);
    }
    public function listItems($id)
    {
        //
        $rifas = Rifa::find($id)->with("items")->get();


        return $rifas;

//        $items->rifas[0]->name = str_slug($items->rifas[0]->name);

//        return view('pages.admin.edititems')->with('items', $items);
    }

    public function image($id)
    {
        //
        $items = Item::with('rifas')->where(['id'=> $id])->first();

        $items->rifas[0]->name = str_slug($items->rifas[0]->name);

        return view('pages.admin.imageitems')->with('items', $items);
    }


    public function find($id)
    {
        //
       $items = Item::with('rifas', 'tipo')->where(['id'=> $id])->first();
        $tipo = TipoItem::all();

        return response()->json(["items"=> $items, 'tipo'=> $tipo]);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateImage(Request $request, $id)
    {
        //

        if($request->hasFile('file') && $request->file('file')->isValid())
        {
            $itemTemp =     Item::find($id);
            $data =  $itemTemp->first();
            unlink( storage_path('app/public/rifas/'.$data->imagem));
            Croppa::delete("storage/rifas/$data->imagem");

            $name =  $data->id.kebab_case($data->name);

            $extension = $request->file('file')->extension();

            $nameFile = "{$name}.{$extension}";

            $upload =  $request->file('file')->storeAs('rifas', $nameFile, 'public');

            $data->imagem =  $nameFile;


            $data->save();

            return response()->json($itemTemp);
        }
    }



    public function  listaRifas(Request $request, $id){

        $items = Item::find($id);
        $array = [];

        $status = Auth::check();
        $valorTotal = $items->num_rifias;
        $total_pages = ceil($valorTotal / 68);
        $is_Page = $request->input('page') ? $request->input('page'): 1;
        $array['total_page'] = $total_pages;
        $offset = ($is_Page-1) * 68;
        $no_of_records_per_page = ($is_Page) * 68;

        for ($contador = $offset + 1; $contador <= $no_of_records_per_page; $contador++) :

            $where = ['numeber'=> $contador, "items_id" => $id];

            $users = DB::table('items_jogador')
                ->join('jogadors', 'jogadors.id', '=', 'items_jogador.jogador_id')

                ->select('avatar')->where($where)->get();



            if (count($users)) {

                foreach ($users as $dados_rifas):

//
                    if ($dados_rifas->avatar) {

                        $foto =  url("storage/jogadores/{$dados_rifas->avatar}");
                    } else {
                        $foto = '/imagem/profiler.png';
                    }

                    $array ['dados'] [] = ['numero' => $contador, "thumb" => $foto, "status_logado" => $status];
                endforeach;
            } else {
                $array ['dados'][] = ['numero' => $contador, "thumb" => "", "status_logado" => $status];
            }
            if($contador >= $valorTotal){
                unset($array[$contador]);
                break;
            }
            endfor;

        return $array;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
