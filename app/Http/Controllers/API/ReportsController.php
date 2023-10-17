<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
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
        // $tipo = json_decode(stripslashes($request->get('tipo')));

        $data = Rotas::where('nome', 'like', '%' . $descricao . '%')
            ->orWhere('escolas', 'like', '%' . $escola)
            // ->where('tipo', 'like', '%' . $tipo)
            ->get();

        return $this->sendResponse($data, 'Report retrieved successfully');
    }
}
