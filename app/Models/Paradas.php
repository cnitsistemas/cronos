<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paradas extends Model
{
    public $table = 'paradas';

    public $fillable = [
        'descricao',
        'rota_id',
        'aluno_id'
    ];

    protected $casts = [
        'descricao' => 'string',
        'rota_id' => 'integer',
        'aluno_id' => 'integer'
    ];

    public static array $rules = [
        'descricao' => 'required',
        'rota_id' => 'required',
        'aluno_id' => 'required'
    ];

    
}
