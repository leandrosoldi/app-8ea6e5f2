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
        'action' =>'required|Integer',
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
