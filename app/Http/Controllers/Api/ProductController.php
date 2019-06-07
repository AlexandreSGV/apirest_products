<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Response;
use App\Api\ApiError;

class ProductController extends Controller
{
	private $product;


    public function __construct(Product $product){

    	$this->product = $product;

    }


    public function index(){
    	
    	return response()->json($this->product->paginate(5));    	
    }

    public function show($id){

    	$product = $this->product->find($id);
    	if(!$product ) return response()->json(
    		ApiError::errorMessage('Produto nao encontrado!', 1010 ), 404);

    	$data = ['data' => $product];
    	
    	return response()->json($data);
    }

    public function store(Request $request){
    	// $out = new \Symfony\Component\Console\Output\ConsoleOutput();
    	// $out->writeln("Entrou store");
    	try{
    		// $out->writeln("Entrou try");
	    	$productData = $request->all();
	    	$this->product->create($productData);
	    	$return = ['data' => ['msg' => 'Produto criado com sucesso!']];
	    	return response()->json($return, 201);
	    }catch(\Exception $e){
    		
	    	
    		return response()->json(ApiError::errorMessage($e->getMessage(), 1010 ), 500);
	    }
		return response()->json(ApiError::errorMessage("Aconteceu algum erro na criação do produto!", 1010 ), 500);

    }

    public function update(Request $request, $id){
    	
    	try{
    		
    		$productData = $request->all();
	    	$product = $this->product->find($id);
	    	$product->update($productData);
	    	$return = ['data' => ['msg' => 'Produto atualizado com sucesso!']];
	    	return response()->json($return, 201);
	    
	    }catch(\Exception $e){
    			    	
    		return response()->json(ApiError::errorMessage($e->getMessage(), 1011 ), 500);
	    
	    }
		return response()->json(ApiError::errorMessage("Aconteceu algum erro na atualização do produto!", 1011 ),500);

    }


    public function delete(Product $id){
    	
    	try{
    		$id->delete();
    		return response()->json( ['data' => [ 'msg' => 'Produto '.$id->name .' deletado com sucesso!' ]] , 200);

	    }catch(\Exception $e){
    			    	
    		return response()->json(ApiError::errorMessage($e->getMessage(), 1012 ),500);
	    
	    }
		return response()->json(ApiError::errorMessage("Aconteceu um erro ao deletar o produto!", 1012 ), 500);

    }


}
