<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFrequenciaAPIRequest;
use App\Http\Requests\API\UpdateFrequenciaAPIRequest;
use App\Models\Frequencia;
use App\Repositories\FrequenciaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AlunosRepository;
use App\Repositories\FrequenciaAlunoRepository;

/**
 * Class FrequenciaAPIController
 */
class FrequenciaAPIController extends AppBaseController
{
    private FrequenciaRepository $frequenciaRepository;
    private AlunosRepository $alunosRepository;
    private FrequenciaAlunoRepository $frequenciaAlunoRepository;

    public function __construct(FrequenciaRepository $frequenciaRepo, AlunosRepository $alunosRepo, FrequenciaAlunoRepository $frequenciaAlunoRepo)
    {
        $this->frequenciaRepository = $frequenciaRepo;
        $this->alunosRepository = $alunosRepo;
        $this->frequenciaAlunoRepository = $frequenciaAlunoRepo;
    }

    /**
     * Display a listing of the Frequencias.
     * GET|HEAD /frequencias
     */
    public function index(Request $request): JsonResponse
    {
        $frequencias = $this->frequenciaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($frequencias->toArray(), 'Frequencias retrieved successfully');
    }

    /**
     * Store a newly created Frequencia in storage.
     * POST /frequencias
     */
    public function store(CreateFrequenciaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $frequencia = $this->frequenciaRepository->create($input);

        return $this->sendResponse($frequencia->toArray(), 'Frequencia saved successfully');
    }

    /**
     * Display the specified Frequencia.
     * GET|HEAD /frequencias/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Frequencia $frequencia */
        $frequencia = $this->frequenciaRepository->find($id);

        if (empty($frequencia)) {
            return $this->sendError('Frequencia not found');
        }

        return $this->sendResponse($frequencia->toArray(), 'Frequencia retrieved successfully');
    }

    /**
     * Update the specified Frequencia in storage.
     * PUT/PATCH /frequencias/{id}
     */
    public function update($id, UpdateFrequenciaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Frequencia $frequencia */
        $frequencia = $this->frequenciaRepository->find($id);

        if (empty($frequencia)) {
            return $this->sendError('Frequencia not found');
        }

        $frequencia = $this->frequenciaRepository->update($input, $id);

        return $this->sendResponse($frequencia->toArray(), 'Frequencia updated successfully');
    }

    /**
     * Remove the specified Frequencia from storage.
     * DELETE /frequencias/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Frequencia $frequencia */
        $frequencia = $this->frequenciaRepository->find($id);

        if (empty($frequencia)) {
            return $this->sendError('Frequencia not found');
        }

        $frequencia->delete();

        return $this->sendSuccess('Frequencia deleted successfully');
    }

    public function frequency($id)
    {

        $chamada = $this->frequenciaRepository->model()::findOrFail($id);

        $presencas = $this->frequenciaAlunoRepository->model()::where('frequencia_id', $chamada->id)->get();

        $alunos = $this->alunosRepository->model()::where('rota_id', $chamada->rota_id)->get();

        $data['chamada'] = $chamada;
        $data['alunos'] = $alunos;
        $data['presencas'] = $presencas;

        return $this->sendResponse($data, 'Frequencias retrieved successfully');
    }

    public function make_frequency($id, Request $request)
    {

        $data = $request->all();

        $chamada = $this->frequenciaRepository->model()::find($id);

        $alunos = $this->alunosRepository->model()::where('rota_id', $chamada->rota_id)->get();

        foreach ($alunos as $aluno) {

            $chamada_aluno = $this->frequenciaAlunoRepository->model()::where(['aluno_id' => $aluno->id, 'frequencia_id' => $id])->first();
            $presenca = 0;

            foreach ($data as $item) {
                if($item['aluno_id'] === $aluno->id){
                    $presenca = $item['presenca'];
                }
            }

            if (isset($chamada_aluno)) {
                $chamada_aluno = $this->frequenciaAlunoRepository->model()::find($chamada_aluno->id);
                $chamada_aluno->presenca = $presenca;
                $chamada_aluno->save();
            } else {
                $this->frequenciaAlunoRepository->model()::create(['aluno_id' => $aluno->id, 'presenca' => $presenca, 'frequencia_id' => $id]);
            }
        }

        $chamada = $this->frequenciaRepository->model()::find($id);

        $chamada->realizada = 1;

        $chamada->save();

        return $this->sendResponse($chamada->toArray(), 'Frequencia realizada com sucesso');
    }
}
