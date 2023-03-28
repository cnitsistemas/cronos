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

        return $this->sendResponse($frequenciaAlunos->toArray(), 'Frequencia Alunos retrieved successfully');
    }

    /**
     * Store a newly created FrequenciaAluno in storage.
     * POST /frequencia-alunos
     */
    public function store(CreateFrequenciaAlunoAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $frequenciaAluno = $this->frequenciaAlunoRepository->create($input);

        return $this->sendResponse($frequenciaAluno->toArray(), 'Frequencia Aluno saved successfully');
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
            return $this->sendError('Frequencia Aluno not found');
        }

        return $this->sendResponse($frequenciaAluno->toArray(), 'Frequencia Aluno retrieved successfully');
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
            return $this->sendError('Frequencia Aluno not found');
        }

        $frequenciaAluno = $this->frequenciaAlunoRepository->update($input, $id);

        return $this->sendResponse($frequenciaAluno->toArray(), 'FrequenciaAluno updated successfully');
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
            return $this->sendError('Frequencia Aluno not found');
        }

        $frequenciaAluno->delete();

        return $this->sendSuccess('Frequencia Aluno deleted successfully');
    }
}
