<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VeiculoCondutores extends Model
{
    public $table = 'veiculo_condutores';

    public $fillable = [
        'veiculo_id',
        'condutor_id',
        'active'
    ];

    protected $casts = [
        'veiculo_id' => 'integer',
        'condutor_id' => 'integer',
        'active' => 'integer'
    ];

    public static array $rules = [
        'veiculo_id' => 'required',
        'condutor_id' => 'required'
    ];

    public function condutor()
    {
        return $this->belongsTo(Condutores::class, 'condutor_id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Veiculos::class, 'veiculo_id');
    }
}
