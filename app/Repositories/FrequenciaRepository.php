<?php

namespace App\Repositories;

use App\Models\Frequencia;
use App\Repositories\BaseRepository;

class FrequenciaRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'data_chamada',
        'realizada',
        'rota_id',
        'turno'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Frequencia::class;
    }
}
