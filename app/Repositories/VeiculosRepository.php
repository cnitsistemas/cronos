<?php

namespace App\Repositories;

use App\Models\Veiculos;
use App\Repositories\BaseRepository;

class VeiculosRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'descricao',
        'tipo',
        'identificacao',
        'ativo'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Veiculos::class;
    }
}
