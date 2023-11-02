<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateParadasAPIRequest;
use App\Http\Requests\API\UpdateParadasAPIRequest;
use App\Models\Paradas;
use App\Repositories\ParadasRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ParadasAPIController
 */
class ParadasAPIController extends AppBaseController
{
    private ParadasRepository $paradasRepository;

    public function __construct(ParadasRepository $paradasRepo)
    {
        $this->paradasRepository = $paradasRepo;
    }

    /**
     * Display a listing of the Paradas.
     * GET|HEAD /paradas
     */
    public function index(Request $request): JsonResponse
    {
        $paradas = $this->paradasRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($paradas->toArray(), 'Paradas retrieved successfully');
    }

    /**
     * Store a newly created Paradas in storage.
     * POST /paradas
     */
    public function store(CreateParadasAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $paradas = $this->paradasRepository->create($input);

        return $this->sendResponse($paradas->toArray(), 'Paradas saved successfully');
    }

    /**
     * Display the specified Paradas.
     * GET|HEAD /paradas/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Paradas $paradas */
        $paradas = $this->paradasRepository->find($id);

        if (empty($paradas)) {
            return $this->sendError('Paradas not found');
        }

        return $this->sendResponse($paradas->toArray(), 'Paradas retrieved successfully');
    }

    /**
     * Update the specified Paradas in storage.
     * PUT/PATCH /paradas/{id}
     */
    public function update($id, UpdateParadasAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Paradas $paradas */
        $paradas = $this->paradasRepository->find($id);

        if (empty($paradas)) {
            return $this->sendError('Paradas not found');
        }

        $paradas = $this->paradasRepository->update($input, $id);

        return $this->sendResponse($paradas->toArray(), 'Paradas updated successfully');
    }

    /**
     * Remove the specified Paradas from storage.
     * DELETE /paradas/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Paradas $paradas */
        $paradas = $this->paradasRepository->find($id);

        if (empty($paradas)) {
            return $this->sendError('Paradas not found');
        }

        $paradas->delete();

        return $this->sendSuccess('Paradas deleted successfully');
    }
}
