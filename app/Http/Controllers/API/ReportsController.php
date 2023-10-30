<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Alunos;
use App\Models\Rotas;
use App\Repositories\RotasRepository;
use Illuminate\Http\JsonResponse;
use PDF;

class ReportsController extends AppBaseController
{
    private RotasRepository $rotasRepository;

    public function __construct(RotasRepository $rotasRepo)
    {
        $this->rotasRepository = $rotasRepo;
    }

    public function getRouterReports(Request $request): JsonResponse
    {
        $descricao = json_decode(stripslashes($request->get('descricao')));
        $escola = json_decode(stripslashes($request->get('escola')));
        $tipo = json_decode(stripslashes($request->get('tipo')));
        $matutino = json_decode(stripslashes($request->get('matutino')));
        $vespertino = json_decode(stripslashes($request->get('vespertino')));
        $noturno = json_decode(stripslashes($request->get('noturno')));

        $data = Rotas::where('nome', 'like', '%' . $descricao . '%')
            ->where('escolas', 'like', '%' . $escola . '%')
            ->where('tipo', 'like', '%' . $tipo . '%')
            ->where('turno_matutino', $matutino)
            ->where('turno_vespertino', $vespertino)
            ->where('turno_noturno', $noturno)

            ->get();

        return $this->sendResponse($data, 'Report retrieved successfully');
    }

    public function getStudentsReports(Request $request): JsonResponse
    {
        $nome = $request->get('nome');
        $escola = $request->get('escola');
        $rota = $request->get('rota');
        $turno = $request->get('turno');

        $data = Alunos::where('nome', 'like', '%' . $nome . '%')
            ->where('nome_escola', 'like', '%' . $escola . '%')
            ->where('rota_id', $rota)
            ->where('turno', 'like', '%' . $turno . '%')
            ->get();

        return $this->sendResponse($data, 'Report retrieved successfully');
    }
}
