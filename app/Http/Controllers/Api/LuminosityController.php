<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Luminosity;
use Illuminate\Http\Response;
use App\Api\ApiError;

class LuminosityController extends Controller
{
	private $luminosity;


    public function __construct(Luminosity $luminosity){

    	$this->luminosity = $luminosity;

    }


    public function index(){
    	
    	return response()->json($this->luminosity->paginate(5));    	
    }

    public function show($id){

    	$luminosity = $this->luminosity->find($id);
    	if(!$luminosity ) return response()->json(
    		ApiError::errorMessage('Luminosidade nao encontrado!', 1010 ), 404);

    	$data = ['data' => $luminosity];
    	
    	return response()->json($data);
    }

    public function store(Request $request){
    	// $out = new \Symfony\Component\Console\Output\ConsoleOutput();
    	// $out->writeln("Entrou store");
    	try{
    		// $out->writeln("Entrou try");
	    	$luminosityData = $request->all();
	    	$this->luminosity->create($luminosityData);
	    	$return = ['data' => ['msg' => 'Laravel: Luminosidade criado com sucesso!']];
	    	return response()->json($return, 201);
	    }catch(\Exception $e){
    		
	    	
    		return response()->json(ApiError::errorMessage($e->getMessage(), 1010 ), 500);
	    }
		return response()->json(ApiError::errorMessage("Aconteceu algum erro na criação do luminosidade!", 1010 ), 500);

    }

    public function update(Request $request, $id){
    	
    	try{
    		
    		$luminosityData = $request->all();
	    	$luminosity = $this->luminosity->find($id);
	    	$luminosity->update($luminosityData);
	    	$return = ['data' => ['msg' => 'Luminosidade atualizado com sucesso!']];
	    	return response()->json($return, 201);
	    
	    }catch(\Exception $e){
    			    	
    		return response()->json(ApiError::errorMessage($e->getMessage(), 1011 ), 500);
	    
	    }
		return response()->json(ApiError::errorMessage("Aconteceu algum erro na atualização do luminosidade!", 1011 ),500);

    }


    public function delete(Luminosity $id){
    	
    	try{
    		$id->delete();
    		return response()->json( ['data' => [ 'msg' => 'Luminosidade '.$id->name .' deletado com sucesso!' ]] , 200);

	    }catch(\Exception $e){
    			    	
    		return response()->json(ApiError::errorMessage($e->getMessage(), 1012 ),500);
	    
	    }
		return response()->json(ApiError::errorMessage("Aconteceu um erro ao deletar o luminosidade!", 1012 ), 500);

    }


}
