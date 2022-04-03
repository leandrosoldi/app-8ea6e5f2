<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutoEstoque;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    private $fields = [
        'action' =>'required|Integer|min:1|max:2',
        'nome' =>'required|String',
        'sku' =>'required|String|unique:produto',
        'quantidade' => 'required|Integer|min:0'
    ];
    
    public function store(Request $request, Produto $produto)
    {
        $fields = $this->fields;
        unset($fields['action']);
        $messages = ['sku.unique' => 'SKU informado já cadastrado'];
        if($response = $this->validateFields($request, $fields, $messages)){
            return response()->json($response,Response::HTTP_BAD_REQUEST);
        } 
        
        $produto->nome = $request['nome'];
        $produto->sku = $request['sku'];
        $produto->save();
        if($produto){
           ProdutoEstoque::create([
                'produto_id' => $produto->id,
                'quantidade' => $request['quantidade'],
           ]); 
        }
        $response['success'] = true;
        $response['message'] = 'Produto cadastrado com sucesso!';
        return response()->json($response);
            
    }

    public function update(Request $request)
    {
        $fields = $this->fields;
        unset($fields['nome']);
        $fields['sku'] = 'required|String|exists:produto';
        $messages = ['action.min' => 'O campo action deve ser 1 ou 2'];
        $messages = ['action.max' => 'O campo action deve ser 1 ou 2'];
        if($response = $this->validateFields($request, $fields,$messages)){
            return response()->json($response,Response::HTTP_BAD_REQUEST);
        }
        $produto = Produto::where('sku',$request['sku'])->first(); 
        $produtoEstoque = ProdutoEstoque::where('produto_id',$produto->id)->first();
        $produtoEstoque->quantidade = $request['action'] == 1 ? $produtoEstoque->quantidade + $request['quantidade'] :
                                      $produtoEstoque->quantidade - $request['quantidade'];
        if($produtoEstoque->quantidade < 0){
            $response['success'] = false;
            $response['message'] = 'Operação não permitida. Estoque insuficiente!';
            return response()->json($response,Response::HTTP_BAD_REQUEST);
        }

        $produtoEstoque->save();
        $response['success'] = true;
        $response['message'] = 'Produto alterado com sucesso!';
        return response()->json($response);
    }

    public function validateFields($request,$fields,$messages = []){
        $validator = Validator::make($request->all(), $fields, $messages);
        if($validator->fails()){
            $response['success'] = false;
            $response['message'] = $validator->messages();
            return $response;
        }
        return;
    }
    
}
