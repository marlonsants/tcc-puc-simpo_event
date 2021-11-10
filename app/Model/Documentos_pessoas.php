<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Documentos_pessoas extends Model
{
    protected $table = 'documentos_pessoas';

   	public $timestamps = false;
   	private $numero;
   	private $tipo_documento_id;
   	private $pessoa_id;
    protected $fillable = [

    'id',
    'numero',
    'tipo_documento_id',
    'pessoa_id'
    ];

    
    public static function SetDocumento(Array $documento){
    	
    	$insert = Documentos_pessoas::Create($documento);
    }

    
    public function tipo()
    {
        return $this->hasOne('App\Model\Documentos_tipos','id','tipo_documento_id');
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     *
     * @return self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTipoDocumentoId()
    {
        return $this->tipo_documento_id;
    }

    /**
     * @param mixed $tipo_documento_id
     *
     * @return self
     */
    public function setTipoDocumentoId($tipo_documento_id)
    {
        $this->tipo_documento_id = $tipo_documento_id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPessoaId()
    {
        return $this->pessoa_id;
    }

    /**
     * @param mixed $pessoa_id
     *
     * @return self
     */
    public function setPessoaId($pessoa_id)
    {
        $this->pessoa_id = $pessoa_id;

        return $this;
    }
}
