<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVeiculosAPIRequest;
use App\Http\Requests\API\UpdateVeiculosAPIRequest;
use App\Models\Veiculos;
use App\Repositories\VeiculosRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class VeiculosAPIController
 */
class VeiculosAPIController extends AppBaseController
{
    private VeiculosRepository $veiculosRepository;

    public function __construct(VeiculosRepository $veiculosRepo)
    {
        $this->veiculosRepository = $veiculosRepo;
    }

    /**
     * Display a listing of the Veiculos.
     * GET|HEAD /veiculos
     */
    public function index(Request $request): JsonResponse
    {
        $veiculos = $this->veiculosRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($veiculos->toArray(), 'Veiculos retrieved successfully');
    }

    public function all()
    {
        $veiculos = Veiculos::orderBy('nome', 'ASC')->get();

        return $this->sendResponse($veiculos, 'Veiculos recuperados com sucesso');
    }

    /**
     * Store a newly created Veiculos in storage.
     * POST /veiculos
     */
    public function store(CreateVeiculosAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $veiculos = $this->veiculosRepository->create($input);

        return $this->sendResponse($veiculos->toArray(), 'Veiculos saved successfully');
    }

    /**
     * Display the specified Veiculos.
     * GET|HEAD /veiculos/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Veiculos $veiculos */
        $veiculos = $this->veiculosRepository->find($id);

        if (empty($veiculos)) {
            return $this->sendError('Veiculos not found');
        }

        return $this->sendResponse($veiculos->toArray(), 'Veiculos retrieved successfully');
    }

    /**
     * Update the specified Veiculos in storage.
     * PUT/PATCH /veiculos/{id}
     */
    public function update($id, UpdateVeiculosAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Veiculos $veiculos */
        $veiculos = $this->veiculosRepository->find($id);

        if (empty($veiculos)) {
            return $this->sendError('Veiculos not found');
        }

        $veiculos = $this->veiculosRepository->update($input, $id);

        return $this->sendResponse($veiculos->toArray(), 'Veiculos updated successfully');
    }

    /**
     * Remove the specified Veiculos from storage.
     * DELETE /veiculos/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Veiculos $veiculos */
        $veiculos = $this->veiculosRepository->find($id);

        if (empty($veiculos)) {
            return $this->sendError('Veiculos not found');
        }

        $veiculos->delete();

        return $this->sendSuccess('Veiculos deleted successfully');
    }
}
