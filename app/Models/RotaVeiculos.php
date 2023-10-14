<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RotaVeiculos extends Model
{
    public $table = 'rota_veiculos';

    public $fillable = [
        'rota_id',
        'veiculo_id',
        'status'
    ];

    protected $casts = [
        'rota_id' => 'integer',
        'veiculo_id' => 'integer',
        'status' => 'integer'
    ];

    public static array $rules = [
        'rota_id' => 'required',
        'veiculo_id' => 'required'
    ];

    
}
