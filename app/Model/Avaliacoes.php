<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Avaliacoes extends Model
{
    protected $table = 'avaliacoes';
    protected $fillable = [

    'evento',
    'trabalho',
    'avaliador1',
    'avaliador2',
    'avaliacao_concluida1',
    'avaliacao_concluida2',
    'status'
    ];
}
