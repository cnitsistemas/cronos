<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRotaVeiculosAPIRequest;
use App\Http\Requests\API\UpdateRotaVeiculosAPIRequest;
use App\Models\RotaVeiculos;
use App\Repositories\RotaVeiculosRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class RotaVeiculosAPIController
 */
class RotaVeiculosAPIController extends AppBaseController
{
    private RotaVeiculosRepository $rotaVeiculosRepository;

    public function __construct(RotaVeiculosRepository $rotaVeiculosRepo)
    {
        $this->rotaVeiculosRepository = $rotaVeiculosRepo;
    }

    /**
     * Display a listing of the RotaVeiculos.
     * GET|HEAD /rota-veiculos
     */
    public function index(Request $request): JsonResponse
    {
        $rotaVeiculos = $this->rotaVeiculosRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($rotaVeiculos->toArray(), 'Rota Veiculos retrieved successfully');
    }

    /**
     * Store a newly created RotaVeiculos in storage.
     * POST /rota-veiculos
     */
    public function store(CreateRotaVeiculosAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $rotaVeiculos = $this->rotaVeiculosRepository->create($input);

        return $this->sendResponse($rotaVeiculos->toArray(), 'Rota Veiculos saved successfully');
    }

    /**
     * Display the specified RotaVeiculos.
     * GET|HEAD /rota-veiculos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var RotaVeiculos $rotaVeiculos */
        $rotaVeiculos = $this->rotaVeiculosRepository->find($id);

        if (empty($rotaVeiculos)) {
            return $this->sendError('Rota Veiculos not found');
        }

        return $this->sendResponse($rotaVeiculos->toArray(), 'Rota Veiculos retrieved successfully');
    }

    /**
     * Update the specified RotaVeiculos in storage.
     * PUT/PATCH /rota-veiculos/{id}
     */
    public function update($id, UpdateRotaVeiculosAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var RotaVeiculos $rotaVeiculos */
        $rotaVeiculos = $this->rotaVeiculosRepository->find($id);

        if (empty($rotaVeiculos)) {
            return $this->sendError('Rota Veiculos not found');
        }

        $rotaVeiculos = $this->rotaVeiculosRepository->update($input, $id);

        return $this->sendResponse($rotaVeiculos->toArray(), 'RotaVeiculos updated successfully');
    }

    /**
     * Remove the specified RotaVeiculos from storage.
     * DELETE /rota-veiculos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var RotaVeiculos $rotaVeiculos */
        $rotaVeiculos = $this->rotaVeiculosRepository->find($id);

        if (empty($rotaVeiculos)) {
            return $this->sendError('Rota Veiculos not found');
        }

        $rotaVeiculos->delete();

        return $this->sendSuccess('Rota Veiculos deleted successfully');
    }
}
