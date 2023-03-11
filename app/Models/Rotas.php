<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rotas extends Model
{
    public $table = 'rotas';

    public $fillable = [
        'nome',
        'hora_ida_inicio',
        'hora_ida_termino',
        'da_porteira',
        'da_mataburro',
        'da_atoleiro',
        'da_colchete',
        'turno_matutino',
        'turno_vespertino',
        'turno_noturno',
        'hora_volta_inicio',
        'hora_volta_termino',
        'latitude_inicio',
        'longitude_inicio',
        'latitude_termino',
        'longitude_termino',
        'tempo'
    ];

    protected $casts = [
        'nome' => 'string',
        'hora_ida_inicio' => 'string',
        'hora_ida_termino' => 'string',
        'da_porteira' => 'integer',
        'da_mataburro' => 'integer',
        'da_atoleiro' => 'integer',
        'da_colchete' => 'integer',
        'turno_matutino' => 'integer',
        'turno_vespertino' => 'integer',
        'turno_noturno' => 'integer',
        'hora_volta_inicio' => 'string',
        'hora_volta_termino' => 'string',
        'latitude_inicio' => 'string',
        'longitude_inicio' => 'string',
        'latitude_termino' => 'string',
        'longitude_termino' => 'string',
        'tempo' => 'string'
    ];

    public static array $rules = [
        'nome' => 'required',
    ];


}
