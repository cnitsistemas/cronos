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
        'estado'
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
