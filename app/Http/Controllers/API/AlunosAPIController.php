<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAlunosAPIRequest;
use App\Http\Requests\API\UpdateAlunosAPIRequest;
use App\Models\Alunos;
use App\Repositories\AlunosRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class AlunosAPIController
 */
class AlunosAPIController extends AppBaseController
{
    private AlunosRepository $alunosRepository;

    public function __construct(AlunosRepository $alunosRepo)
    {
        $this->alunosRepository = $alunosRepo;
    }

    /**
     * Display a listing of the Alunos.
     * GET|HEAD /alunos
     */
    public function index(Request $request): JsonResponse
    {
        $alunos = $this->alunosRepository->paginate(10);

        return $this->sendResponse($alunos->toArray(), 'Alunos recuperados com sucesso');
    }

    /**
     * Store a newly created Alunos in storage.
     * POST /alunos
     */
    public function store(CreateAlunosAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $alunos = $this->alunosRepository->create($input);

        return $this->sendResponse($alunos->toArray(), 'Aluno salvo com sucesso');
    }

    /**
     * Display the specified Alunos.
     * GET|HEAD /alunos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Alunos $alunos */
        $alunos = $this->alunosRepository->find($id);

        if (empty($alunos)) {
            return $this->sendError('Alunos not found');
        }

        return $this->sendResponse($alunos->toArray(), 'Aluno recuperado com sucesso');
    }

    /**
     * Update the specified Alunos in storage.
     * PUT/PATCH /alunos/{id}
     */
    public function update($id, UpdateAlunosAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Alunos $alunos */
        $alunos = $this->alunosRepository->find($id);

        if (empty($alunos)) {
            return $this->sendError('Alunos not found');
        }

        $alunos = $this->alunosRepository->update($input, $id);

        return $this->sendResponse($alunos->toArray(), 'Aluno atualizado com sucesso');
    }

    /**
     * Remove the specified Alunos from storage.
     * DELETE /alunos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Alunos $alunos */
        $alunos = $this->alunosRepository->find($id);

        if (empty($alunos)) {
            return $this->sendError('Alunos not found');
        }

        $alunos->delete();

        return $this->sendSuccess('Aluno excluído com sucesso');
    }
}
