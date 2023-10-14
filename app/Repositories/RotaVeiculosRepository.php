<?php

namespace App\Repositories;

use App\Models\RotaVeiculos;
use App\Repositories\BaseRepository;

class RotaVeiculosRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'rota_id',
        'veiculo_id',
        'status'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return RotaVeiculos::class;
    }
}
