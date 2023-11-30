<?php

namespace App\Repositories;

use App\Models\VeiculoCondutores;
use App\Repositories\BaseRepository;

class VeiculoCondutoresRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'veiculo_id',
        'condutor_id',
        'active'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return VeiculoCondutores::class;
    }
}
