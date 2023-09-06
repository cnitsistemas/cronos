<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculos extends Model
{
    public $table = 'veiculos';

    public $fillable = [
        'descricao',
        'tipo',
        'identificacao',
        'ativo'
    ];

    protected $casts = [
        'descricao' => 'string',
        'tipo' => 'string',
        'identificacao' => 'string',
        'ativo' => 'integer'
    ];

    public static array $rules = [
        'descricao' => 'required',
        'tipo' => 'required',
        'identificacao' => 'required'
    ];

    
}
