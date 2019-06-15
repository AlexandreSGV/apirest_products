<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Temperature;
use Illuminate\Http\Response;
use App\Api\ApiError;

class TemperatureController extends Controller
{
	private $temperature;


    public function __construct(Temperature $temperature){

    	$this->temperature = $temperature;

    }


    public function index(){
    	
    	return response()->json($this->temperature->paginate(5));    	
    }

    public function show($id){

    	$temperature = $this->temperature->find($id);
    	if(!$temperature ) return response()->json(
    		ApiError::errorMessage('Temperatura nao encontrado!', 1010 ), 404);

    	$data = ['data' => $temperature];
    	
    	return response()->json($data);
    }

    public function store(Request $request){
    	// $out = new \Symfony\Component\Console\Output\ConsoleOutput();
    	// $out->writeln("Entrou store");
    	try{
    		// $out->writeln("Entrou try");
	    	$temperatureData = $request->all();
	    	$this->temperature->create($temperatureData);
	    	$return = ['data' => ['msg' => 'Laravel: Temperatura criado com sucesso!']];
	    	return response()->json($return, 201);
	    }catch(\Exception $e){
    		
	    	
    		return response()->json(ApiError::errorMessage($e->getMessage(), 1010 ), 500);
	    }
		return response()->json(ApiError::errorMessage("Aconteceu algum erro na criação do temperatura!", 1010 ), 500);

    }

    public function update(Request $request, $id){
    	
    	try{
    		
    		$temperatureData = $request->all();
	    	$temperature = $this->temperature->find($id);
	    	$temperature->update($temperatureData);
	    	$return = ['data' => ['msg' => 'Temperatura atualizado com sucesso!']];
	    	return response()->json($return, 201);
	    
	    }catch(\Exception $e){
    			    	
    		return response()->json(ApiError::errorMessage($e->getMessage(), 1011 ), 500);
	    
	    }
		return response()->json(ApiError::errorMessage("Aconteceu algum erro na atualização do temperatura!", 1011 ),500);

    }


    public function delete(Temperature $id){
    	
    	try{
    		$id->delete();
    		return response()->json( ['data' => [ 'msg' => 'Temperatura '.$id->name .' deletado com sucesso!' ]] , 200);

	    }catch(\Exception $e){
    			    	
    		return response()->json(ApiError::errorMessage($e->getMessage(), 1012 ),500);
	    
	    }
		return response()->json(ApiError::errorMessage("Aconteceu um erro ao deletar o temperatura!", 1012 ), 500);

    }

    public function grafico(){
        $nome = "teste";
        return view('grafico', compact('nome'));
    }


}
