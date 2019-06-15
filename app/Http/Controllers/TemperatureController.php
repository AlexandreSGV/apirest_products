<?php

namespace App\Http\Controllers;

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


    

    public function grafico(){
        $nome = "teste";
        return view('grafico', compact('nome'));
    }


}
