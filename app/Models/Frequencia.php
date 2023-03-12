<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frequencia extends Model
{
    public $table = 'frequencias';

    public $fillable = [
        'data_chamada',
        'realizada',
        'rota_id'
    ];

    protected $casts = [
        'data_chamada' => 'string',
        'realizada' => 'integer',
        'rota_id' => 'integer'
    ];

    public static array $rules = [
        'data_chamada' => 'required',
        'realizada' => 'required',
        'rota_id' => 'required'
    ];

    
}
