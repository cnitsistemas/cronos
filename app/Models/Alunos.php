<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    public $table = 'alunos';

    public $fillable = [
        'nome',
        'serie',
        'ensino',
        'turno',
        'nome_escola',
        'rota_id',
        'cep',
        'endereco',
        'bairro',
        'numero',
        'complemento',
        'cidade',
        'estado',
        'turno_matutino',
        'turno_vespertino',
        'turno_noturno',
        'hora_ida',
        'hora_volta',
    ];

    protected $casts = [
        'nome' => 'string',
        'serie' => 'string',
        'ensino' => 'string',
        'turno' => 'string',
        'nome_escola' => 'string',
        'rota_id' => 'integer',
        'cep' => 'string',
        'endereco' => 'string',
        'bairro' => 'string',
        'numero' => 'string',
        'complemento' => 'string',
        'cidade' => 'string',
        'estado' => 'string',
        'turno_matutino' => 'integer',
        'turno_vespertino' => 'integer',
        'turno_noturno' => 'integer',
        'hora_ida' => 'string',
        'hora_volta' => 'string',
    ];

    public static array $rules = [
        'nome' => 'required',
        'serie' => 'required',
        'ensino' => 'required',
        'turno' => 'required',
        'nome_escola' => 'required',
        'rota_id' => 'required'
    ];

    public function route()
    {
        return $this->belongsTo(Rotas::class, 'rota_id');
    }
}
