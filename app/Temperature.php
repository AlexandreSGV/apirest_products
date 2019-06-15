<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    protected $fillable = [
    	'thermometer_id','value'];
}
