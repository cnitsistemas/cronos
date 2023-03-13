<?php

namespace App\Repositories;

use App\Models\Alunos;
use App\Repositories\BaseRepository;

class AlunosRepository extends BaseRepository
{
    protected $fieldSearchable = [
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

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Alunos::class;
    }
}
