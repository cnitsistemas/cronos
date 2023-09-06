<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFrequenciaAlunoAPIRequest;
use App\Http\Requests\API\UpdateFrequenciaAlunoAPIRequest;
use App\Models\FrequenciaAluno;
use App\Repositories\FrequenciaAlunoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class FrequenciaAlunoAPIController
 */
class FrequenciaAlunoAPIController extends AppBaseController
{
    private FrequenciaAlunoRepository $frequenciaAlunoRepository;

    public function __construct(FrequenciaAlunoRepository $frequenciaAlunoRepo)
    {
        $this->frequenciaAlunoRepository = $frequenciaAlunoRepo;
    }

    /**
     * Display a listing of the FrequenciaAlunos.
     * GET|HEAD /frequencia-alunos
     */
    public function index(Request $request): JsonResponse
    {
        $frequenciaAlunos = $this->frequenciaAlunoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($frequenciaAlunos->toArray(), 'Frequências de alunos recuperadas com sucesso');
    }

    /**
     * Store a newly created FrequenciaAluno in storage.
     * POST /frequencia-alunos
     */
    public function store(CreateFrequenciaAlunoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $frequenciaAluno = $this->frequenciaAlunoRepository->create($input);

        return $this->sendResponse($frequenciaAluno->toArray(), 'Frequências de alunos salva com sucesso');
    }

    /**
     * Display the specified FrequenciaAluno.
     * GET|HEAD /frequencia-alunos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var FrequenciaAluno $frequenciaAluno */
        $frequenciaAluno = $this->frequenciaAlunoRepository->find($id);

        if (empty($frequenciaAluno)) {
            return $this->sendError('Frequência de Aluno não encontrada');
        }

        return $this->sendResponse($frequenciaAluno->toArray(), 'Frequência de alunos recuperada com sucesso');
    }

    /**
     * Update the specified FrequenciaAluno in storage.
     * PUT/PATCH /frequencia-alunos/{id}
     */
    public function update($id, UpdateFrequenciaAlunoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var FrequenciaAluno $frequenciaAluno */
        $frequenciaAluno = $this->frequenciaAlunoRepository->find($id);

        if (empty($frequenciaAluno)) {
            return $this->sendError('Frequência de Aluno não encontrada');
        }

        $frequenciaAluno = $this->frequenciaAlunoRepository->update($input, $id);

        return $this->sendResponse($frequenciaAluno->toArray(), 'Frequência de alunos atualizada com sucesso');
    }

    /**
     * Remove the specified FrequenciaAluno from storage.
     * DELETE /frequencia-alunos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var FrequenciaAluno $frequenciaAluno */
        $frequenciaAluno = $this->frequenciaAlunoRepository->find($id);

        if (empty($frequenciaAluno)) {
            return $this->sendError('Frequência de Aluno não encontrada');
        }

        $frequenciaAluno->delete();

        return $this->sendSuccess('Frequência de alunos deletada com sucesso');
    }
}
