<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Trabalho;

class Trabalhos_correcoes extends Model
{
    public $timestamp = false;
    protected $table = 'trabalhos_correcoes';
    protected $fillable = [
    	'trabalho_id',
    	'evento_id',
    	'trabalho_status_id'
    ];

    public function novaCorrecao($trabalho_id){

    	$this->trabalho_id = $trabalho_id;
    	$this->evento_id = session('evento_id');
    	$this->trabalho_status_id = 6;
    	$this->create($this->toArray());
    	// altera status para precisa de correção 
    	Trabalho::alterarStatus($trabalho_id,6);
    }
    // altera o status da correção e do trabalho
    public function alterarStatus($trabalho_id,$status_id){
    	
    	$this->where('trabalho_id',$trabalho_id)
    	->where('evento_id',session('evento_id'))
    	->update(['trabalho_status_id' => $status_id]);

   	}

    // Deleta correção
    public function deletarCorrecao($trabalho_id){
    	
    	$this->where('trabalho_id',$trabalho_id)
    	->where('evento_id',session('evento_id'))
    	->delete();
        Trabalho::alterarStatus($trabalho_id,2);
    	
    }

}
