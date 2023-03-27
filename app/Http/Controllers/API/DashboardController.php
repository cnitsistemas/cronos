<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Repositories\AlunosRepository;
use App\Repositories\RotasRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends AppBaseController
{
    private AlunosRepository $alunosRepository;
    private RotasRepository $rotasRepository;

    public function __construct(AlunosRepository $alunosRepo, RotasRepository $rotasRepo)
    {
        $this->alunosRepository = $alunosRepo;
        $this->rotasRepository = $rotasRepo;
    }

    /**
     * Display a listing of the Dash.
     * GET|HEAD /dashbord
     */

    public function index(Request $request): JsonResponse
    {
        $countStudents = $this->alunosRepository->model()::count();
        $countRotas = $this->rotasRepository->model()::count();
        $lastStudents = $this->alunosRepository->model()::with(['route'])->orderBy('id', 'desc')->take(4)->get();

        $lastRoutes = $this->rotasRepository->model()::orderBy('id', 'desc')->take(4)->get();

        $data['totalAlunos'] = $countStudents;
        $data['totalRotas'] = $countRotas;
        $data['alunos'] = $lastStudents;
        $data['rotas'] = $lastRoutes;

        return $this->sendResponse($data, 'Dados do Dashboard retornados com sucesso!');
    }
}
