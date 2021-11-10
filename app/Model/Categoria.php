<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
     protected $fillable = [
    'evento_id',
    'nome'
  	];
}
