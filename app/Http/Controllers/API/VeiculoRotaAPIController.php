<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVeiculoRotaAPIRequest;
use App\Http\Requests\API\UpdateVeiculoRotaAPIRequest;
use App\Models\VeiculoRota;
use App\Repositories\VeiculoRotaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class VeiculoRotaAPIController
 */
class VeiculoRotaAPIController extends AppBaseController
{
    private VeiculoRotaRepository $veiculoRotaRepository;

    public function __construct(VeiculoRotaRepository $veiculoRotaRepo)
    {
        $this->veiculoRotaRepository = $veiculoRotaRepo;
    }

    /**
     * Display a listing of the VeiculoRotas.
     * GET|HEAD /veiculo-rotas
     */
    public function index(Request $request): JsonResponse
    {
        $id = $request->get('id');

        $veiculoRotas = VeiculoRota::where('veiculo_id', $id)
            ->with(['route'])
            ->with(['vehicle'])
            ->get();

        return $this->sendResponse($veiculoRotas, 'Veiculo Rotas retrieved successfully');
    }

    /**
     * Store a newly created VeiculoRota in storage.
     * POST /veiculo-rotas
     */
    public function store(CreateVeiculoRotaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $veiculoRota = $this->veiculoRotaRepository->create($input);

        return $this->sendResponse($veiculoRota->toArray(), 'Veiculo Rota saved successfully');
    }

    /**
     * Display the specified VeiculoRota.
     * GET|HEAD /veiculo-rotas/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var VeiculoRota $veiculoRota */
        $veiculoRota = $this->veiculoRotaRepository->find($id);

        if (empty($veiculoRota)) {
            return $this->sendError('Veiculo Rota not found');
        }

        return $this->sendResponse($veiculoRota->toArray(), 'Veiculo Rota retrieved successfully');
    }

    /**
     * Update the specified VeiculoRota in storage.
     * PUT/PATCH /veiculo-rotas/{id}
     */
    public function update($id, UpdateVeiculoRotaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var VeiculoRota $veiculoRota */
        $veiculoRota = $this->veiculoRotaRepository->find($id);

        if (empty($veiculoRota)) {
            return $this->sendError('Veiculo Rota not found');
        }

        $veiculoRota = $this->veiculoRotaRepository->update($input, $id);

        return $this->sendResponse($veiculoRota->toArray(), 'VeiculoRota updated successfully');
    }

    /**
     * Remove the specified VeiculoRota from storage.
     * DELETE /veiculo-rotas/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var VeiculoRota $veiculoRota */
        $veiculoRota = $this->veiculoRotaRepository->find($id);

        if (empty($veiculoRota)) {
            return $this->sendError('Veiculo Rota not found');
        }

        $veiculoRota->delete();

        return $this->sendSuccess('Veiculo Rota deleted successfully');
    }
}
