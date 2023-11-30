<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVeiculoCondutoresAPIRequest;
use App\Http\Requests\API\UpdateVeiculoCondutoresAPIRequest;
use App\Models\VeiculoCondutores;
use App\Repositories\VeiculoCondutoresRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class VeiculoCondutoresAPIController
 */
class VeiculoCondutoresAPIController extends AppBaseController
{
    private VeiculoCondutoresRepository $veiculoCondutoresRepository;

    public function __construct(VeiculoCondutoresRepository $veiculoCondutoresRepo)
    {
        $this->veiculoCondutoresRepository = $veiculoCondutoresRepo;
    }

    /**
     * Display a listing of the VeiculoCondutores.
     * GET|HEAD /veiculo-condutores
     */
    public function index(Request $request): JsonResponse
    {
        $id = $request->get('id');

        $veiculoCondutores = VeiculoCondutores::where('condutor_id', $id)
            ->with(['condutor'])
            ->with(['vehicle'])
            ->get();

        return $this->sendResponse($veiculoCondutores->toArray(), 'Veiculo Condutores retrieved successfully');
    }

    /**
     * Store a newly created VeiculoCondutores in storage.
     * POST /veiculo-condutores
     */
    public function store(CreateVeiculoCondutoresAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $veiculoCondutores = $this->veiculoCondutoresRepository->create($input);

        return $this->sendResponse($veiculoCondutores->toArray(), 'Veiculo Condutores saved successfully');
    }

    /**
     * Display the specified VeiculoCondutores.
     * GET|HEAD /veiculo-condutores/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var VeiculoCondutores $veiculoCondutores */
        $veiculoCondutores = $this->veiculoCondutoresRepository->find($id);

        if (empty($veiculoCondutores)) {
            return $this->sendError('Veiculo Condutores not found');
        }

        return $this->sendResponse($veiculoCondutores->toArray(), 'Veiculo Condutores retrieved successfully');
    }

    /**
     * Update the specified VeiculoCondutores in storage.
     * PUT/PATCH /veiculo-condutores/{id}
     */
    public function update($id, UpdateVeiculoCondutoresAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var VeiculoCondutores $veiculoCondutores */
        $veiculoCondutores = $this->veiculoCondutoresRepository->find($id);

        if (empty($veiculoCondutores)) {
            return $this->sendError('Veiculo Condutores not found');
        }

        $veiculoCondutores = $this->veiculoCondutoresRepository->update($input, $id);

        return $this->sendResponse($veiculoCondutores->toArray(), 'VeiculoCondutores updated successfully');
    }

    /**
     * Remove the specified VeiculoCondutores from storage.
     * DELETE /veiculo-condutores/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var VeiculoCondutores $veiculoCondutores */
        $veiculoCondutores = $this->veiculoCondutoresRepository->find($id);

        if (empty($veiculoCondutores)) {
            return $this->sendError('Veiculo Condutores not found');
        }

        $veiculoCondutores->delete();

        return $this->sendSuccess('Veiculo Condutores deleted successfully');
    }
}
