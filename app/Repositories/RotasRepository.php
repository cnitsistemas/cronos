<?php

namespace App\Repositories;

use App\Models\Rotas;
use App\Repositories\BaseRepository;

class RotasRepository extends BaseRepository
{
    protected $fieldSearchable = [
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

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Rotas::class;
    }
}
