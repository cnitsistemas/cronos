<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Condutores extends Model
{
    public $table = 'condutores';

    public $fillable = [
        'nome',
        'tipo_habilitacao',
        'categoria_habilitacao',
        'identificador_documento_habilitacao',
        'validade_habilitacao',
        'idade',
        'cep',
        'endereco',
        'cidade',
        'ativo'
    ];

    protected $casts = [
        'nome' => 'string',
        'tipo_habilitacao' => 'string',
        'categoria_habilitacao' => 'string',
        'identificador_documento_habilitacao' => 'string',
        'validade_habilitacao' => 'string',
        'idade' => 'string',
        'cep' => 'string',
        'endereco' => 'string',
        'cidade' => 'string',
        'ativo' => 'integer'
    ];

    public static array $rules = [
        'nome' => 'required',
        'tipo_habilitacao' => 'required',
        'categoria_habilitacao' => 'required',
        'identificador_documento_habilitacao' => 'required',
        'validade_habilitacao' => 'required',
        'idade' => 'required'
    ];

    
}
