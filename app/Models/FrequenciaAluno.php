<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrequenciaAluno extends Model
{
    public $table = 'frequencia_alunos';

    public $fillable = [
        'aluno_id',
        'frequencia_id',
        'presenca'
    ];

    protected $casts = [
        'aluno_id' => 'integer',
        'frequencia_id' => 'integer',
        'presenca' => 'integer'
    ];

    public static array $rules = [
        'aluno_id' => 'required',
        'frequencia_id' => 'required',
        'presenca' => 'required'
    ];

    
    public function chamada()
    {
        return $this->belongsTo(Frequencia::class, 'frequencia_id');
    }
}
