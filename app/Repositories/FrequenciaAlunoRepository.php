<?php

namespace App\Repositories;

use App\Models\FrequenciaAluno;
use App\Repositories\BaseRepository;

class FrequenciaAlunoRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'aluno_id',
        'frequencia_id',
        'presenca'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return FrequenciaAluno::class;
    }
}
