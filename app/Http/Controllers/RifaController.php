<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use App\Models\Rifa;
use App\Repositories\RifaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Validator;
use Illuminate\Support\Facades\DB;

class RifaController extends Controller
{

    public  $repository;

    /**
     * RifaController constructor.
     * @param $repository
     */
    public function __construct( RifaRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $validatedData = Validator::make($request->all(), [

            'name' => 'required',
            'idCat' => 'required',
            'date_inicio' => 'required',
            'date_fim' => 'required'

        ]);
//
        if ($validatedData->fails()) {
            return response()->json($validatedData->fails());
        }

        $idCat = $request->input('idCat');


        $saved = DB::table('rifas')->insert(
            [
                'name' => $request->input('name'),
                'date_inicio' => $request->input('date_inicio'),
                'date_fim' => $request->input('date_fim'),
                'categoria_id' => $idCat,
                'updated_at' => date('Y-m-d'),
                'created_at' => date('Y-m-d'),
                'ordem' => 0,


            ]);


        if($saved){
           return  response()->json(['error'=> false]);
        }
        response()->json(['error'=> true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        $where = ['id'=> $id];
        $rifas = Rifa::where($where)->first();
        $categoria = Categoria::all();

        return view('pages.admin.editrifas')->with(['rifas' => $rifas, 'categorias'=> $categoria]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = $request->input('id');
        $categoria = $request->input('categoria');
        $validatedData = Validator::make($request->all(), [

            'name' => 'required',
            'categoria' => 'required',
            'date_inicio' => 'required',
            'date_fim' => 'required'

        ]);

        if ($validatedData->fails()) {
            return redirect('admin/rifas/edit/'.$id)
                ->withErrors($validatedData)
                ->withInput();
        }
        //
        $where = ['id'=> $id];
        $rifas = Rifa::where($where)->first();

        $saved = $rifas->update([
            'name' => $request->input('name'),
            'ordem' => 1,
            'categoria_id' => $request->input('categoria'),
            'date_inicio' => date('Y-m-d', strtotime($request->input('date_inicio'))),
            'date_fim' => date('Y-m-d', strtotime($request->input('date_fim'))),
        ], $where);

          if($saved){


              return redirect('admin/rifas/edit/'.$id)->with('success', 'Dados salvo com sucesso');
          }

        return redirect('admin/rifas/edit/'.$id)->with('error', 'Error ao salvar dados');
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

    public  function  findCat($name){
        $where = ['slug'=> $name];

        $categoria = Categoria::where($where)->first();


        $where = ['categoria_id'=> $categoria->id];

        $rifas = Rifa::where($where)->with(['items.jogadors'])->where($where)->get();



        return view('pages.admin.rifas' )->with(['categoria'=> $categoria, 'rifas'=> $rifas ]);

    }

    public  function items($id){

        $where = ['id'=> $id];
        $rifas = Rifa::where($where)->with('items')->get();
        $where_categoria = ['id'=> $rifas[0]->categoria_id];
        $categoria = Categoria::where($where_categoria)->first();

        return view('pages.admin.items' )->with(['rifas' =>$rifas, 'categoria'=> $categoria]);



    }
    public  function findRifas($id){

        $where = ['categoria_id'=> $id];
        $rifas = Rifa::where($where)->get();

        return $rifas;

    }

    public  function  listAll($name){


        $where = ['name'=> $name];

        $rifas = Rifa::where($where)->with('items.jogadors')->where($where) ->orderBy('created_at', 'desc')->get();

        return $rifas;
    }

    public  function  categoria($name){

        $where = ['slug'=> $name];

        $categoria = Categoria::where($where)->first();

        $where = ['categoria_id'=> $categoria->id, 'is_fechada' => 0];

        $rifas = Rifa::where($where)->where('date_fim','<=' ,date('Y-m-d'))->with(['items' => function ($query) {
            $query->where('status', 1);

        }])->where($where)->get();



        return view('pages.rifas' )->with(['rifas'=> $rifas, 'categoria' => $categoria]);
    }

    public  function  historicos(){

        $where = ['is_fechada' => 1,'status'=> 1];

//        $rifas = Rifa::all()->with(['items' => function ($query) {
//            $query->where('status', 1);
//
//        }])->where($where)->get();
        $rifas = $this->repository->findBy(['is_fechada'=>1, 'status'=>1], ['date_fim'=>'asc']);
return response()->json($rifas);

        return view('pages.rifas' )->with(['rifas'=> $rifas]);
    }
}
