<?php

namespace App\Repositories;

use App\Models\Paradas;
use App\Repositories\BaseRepository;

class ParadasRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'descricao',
        'rota_id',
        'aluno_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Paradas::class;
    }
}
