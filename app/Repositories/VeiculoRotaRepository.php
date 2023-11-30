<?php

namespace App\Repositories;

use App\Models\VeiculoRota;
use App\Repositories\BaseRepository;

class VeiculoRotaRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'rota_id',
        'veiculo_id',
        'active'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return VeiculoRota::class;
    }
}
