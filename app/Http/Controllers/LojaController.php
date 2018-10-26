<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Jogador;
use App\Models\Loja;
use App\Models\Slider;
use App\Repositories\LojaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LojaController extends Controller
{
    //
    public $repository;

    /**
     * LojaController constructor.
     */
    public function __construct(LojaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {

    }

    public function lojaInvatario()
    {

    }

    public function compraAtivar($id)
    {
        $loja = Loja::find($id);
        $loja->status = 1;
        $saved = $loja->save();
        if ($saved) {
            return redirect('admin/loja/loja-compra')->with('success', 'Dados atualizado com sucesso');

        }
        return redirect('admin/loja/loja-compra')->with('error', 'Erro ao  atualizado com sucesso');
    }

    public function compraDesativar($id)
    {
        $loja = Loja::find($id);

        $loja->status = 0;
        $saved = $loja->save();
        if ($saved) {
            return redirect('admin/loja/loja-compra')->with('success', 'Dados atualizado com sucesso');

        }
        return redirect('admin/loja/loja-compra')->with('error', 'Erro ao atualizado com sucesso');


    }

    public function editarCompra(Request $request)
    {
        $idLoja = $request->input('lojaId');
        $itemID = $request->input('item');

        $where = ['id' => $idLoja];
        $loja = Loja::where($where)->first();
        $loja->item_id = $itemID;
        $saved = $loja->save();

        if ($saved) {
            return redirect('admin/loja/loja-compra')->with('success', 'Dados atualizado com sucesso');
        }
        return redirect('admin/loja/loja-compra')->with('error', 'Erro ao atualizado com sucesso');

    }

    public function compraEditar($id)
    {
        $whre = ['id' => $id];

        $compras = Loja::where($whre)->with('items')->first();

        $where = ['status' => 1];
        $item = Item::where($where)->get();


        return view('pages.admin.editarLojaCompra')->with(['items' => $item, 'loja' => $compras]);


    }

    public function salvarCompra(Request $request)
    {
        $itemID = $request->input('item');

        $data = ['status' => 1, 'item_id' => $itemID, 'tipo' => 1];

        $saved = $this->repository->create($data);

        if ($saved) {
            return redirect('admin/loja/loja-compra')->with('success', 'Dados salvo com sucesso');

        }
        return redirect('admin/loja/loja-compra')->with('error', 'Erro ao salvar dados');


    }

    public function sliderLojaCompra()
    {

    }

    public function webLojaCompra()
    {
        $whre = ['tipo' => 1, 'status' => 1];

        $compras = Loja::where($whre)->with(['items' => function ($query) {
            $query->where('status', 1);
        }])->orderBy('id', 'asc')->get();

        $slider = Slider::all();

        return view('pages.loja-compra')->with(['compras' => $compras, 'sliders' => $slider]);
    }

    public function sliderCompra()
    {
        $imagem = Slider::where(["tipo" => 1])->get();
        return view('pages.admin.listSlider')->with(['imagens' => $imagem]);

    }

    public function formSliderCompra()
    {
        return view('pages.admin.imagelojaCompra');
    }

    public function deleteSliderCompra($id)
    {
        $itemTemp = Slider::find($id);

        if ($itemTemp->imagem != null) {

            Croppa::delete("storage/slider/$itemTemp->imagem");
            unlink(storage_path('app/public/slider/' . $itemTemp->imagem));

            $itemTemp->delete();

            return redirect('/admin/loja/slider-compra')->with('success', 'Imagem removida com sucesso');
        }
    }

    public function storeSliderCompra(Request $request)
    {

        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $itemTemp = Slider::create([
                'tipo' => 1,
                'status' => 1
            ]);

            $name = $itemTemp->id . kebab_case("tse" . $itemTemp->id);


            $extension = $request->file('file')->extension();

            $nameFile = "{$name}.{$extension}";

            $upload = $request->file('file')->storeAs('slider', $nameFile, 'public');

            $itemTemp->imagem = $nameFile;


            $itemTemp->save();

            return response()->json($itemTemp);
        }

    }

    public function compraCredito($id)
    {
        if (auth()->guard('jogador')->user()) {
            $user = auth()->guard('jogador')->user();
            $loja = Loja::find($id);
            if ($loja->items->status == 1) {
                if ($user->saldo->saldo >= $loja->items->valor_credito) {
                    $saved = $user->loja()->attach($loja->id, [
                        "valor_credito" => 1,
                        "valor_resgate" => 0,
                        "valor_essencia" => 0,
                    ]);

                    $user->saldo->saldo = $user->saldo->saldo - $loja->items->valor_credito;
                    $user->saldo->save();

                    return redirect('loja/loja-compra')->with(["success" => "Compra realizada com sucesso"]);
                } else {
                    return redirect('loja/loja-compra')->with(["error" => "Você não tem crédito suficiente"]);
                }
            } else {
                return redirect('loja/loja-compra')->with(["error" => "Este item não esta ativo"]);
            }

        }

        return redirect('loja/loja-compra')->with(["error" => "Você não esta logado"]);


    }

    public function compraEssencia($id)
    {
        if (auth()->guard('jogador')->user()) {
            $user = auth()->guard('jogador')->user();
            $loja = Loja::find($id);

            if ($loja->items->status == 1) {
                if ($user->saldo->saldo >= $loja->items->valor_essencia) {
                    $saved = $user->loja()->attach($loja->id, [
                        "valor_credito" => 0,
                        "valor_resgate" => 0,
                        "valor_essencia" => 1,
                    ]);

                    $user->saldo->essencia = $user->saldo->essencia - $loja->items->valor_essencia;
                    $user->saldo->save();

                    return redirect('loja/loja-compra')->with(["success" => "Compra realizada com sucesso"]);
                } else {
                    return redirect('loja/loja-compra')->with(["error" => "Você não tem essencia suficiente"]);
                }
            } else {
                return redirect('loja/loja-compra')->with(["error" => "Este item não esta ativo"]);
            }
        }

        return redirect('loja/loja-compra')->with(["error" => "Você não esta logado"]);


    }


    public function lojacompra()
    {

        $whre = ['tipo' => 1];

        $compras = Loja::where($whre)->with('items')->get();

        $where = ['status' => 1];
        $item = Item::where($where)->get();


        return view('pages.admin.listLojaCompra')->with(['compras' => $compras, 'items' => $item]);
    }

}

