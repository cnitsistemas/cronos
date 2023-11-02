<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VeiculoRota extends Model
{
    public $table = 'veiculo_rotas';

    public $fillable = [
        'rota_id',
        'veiculo_id',
        'active'
    ];

    protected $casts = [
        'rota_id' => 'integer',
        'veiculo_id' => 'integer',
        'active' => 'integer'
    ];

    public static array $rules = [
        'rota_id' => 'required',
        'veiculo_id' => 'required'
    ];

    
}
