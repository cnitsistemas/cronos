<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\Rotas;
use App\Repositories\RotasRepository;
use Illuminate\Http\JsonResponse;

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

        $data = Rotas::where('nome', 'like', '%' . $descricao . '%')->get();

        return $this->sendResponse($data, 'Report retrieved successfully');
    }
}
