<?php

namespace App\Repositories;

use App\Models\Condutores;
use App\Repositories\BaseRepository;

class CondutoresRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'nome',
        'tipo_habilitacao',
        'categoria_habilitacao',
        'identificador_documento_habilitacao',
        'validade_habilitacao',
        'idade',
        'cep',
        'endereco',
        'cidade',
        'ativo'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Condutores::class;
    }
}
