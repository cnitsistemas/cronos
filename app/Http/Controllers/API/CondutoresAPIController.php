<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCondutoresAPIRequest;
use App\Http\Requests\API\UpdateCondutoresAPIRequest;
use App\Models\Condutores;
use App\Repositories\CondutoresRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class CondutoresAPIController
 */
class CondutoresAPIController extends AppBaseController
{
    private CondutoresRepository $condutoresRepository;

    public function __construct(CondutoresRepository $condutoresRepo)
    {
        $this->condutoresRepository = $condutoresRepo;
    }

    /**
     * Display a listing of the Condutores.
     * GET|HEAD /condutores
     */
    public function index(Request $request): JsonResponse
    {
        $condutores = $this->condutoresRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($condutores->toArray(), 'Condutores retrieved successfully');
    }

    /**
     * Store a newly created Condutores in storage.
     * POST /condutores
     */
    public function store(CreateCondutoresAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $condutores = $this->condutoresRepository->create($input);

        return $this->sendResponse($condutores->toArray(), 'Condutores saved successfully');
    }

    /**
     * Display the specified Condutores.
     * GET|HEAD /condutores/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Condutores $condutores */
        $condutores = $this->condutoresRepository->find($id);

        if (empty($condutores)) {
            return $this->sendError('Condutores not found');
        }

        return $this->sendResponse($condutores->toArray(), 'Condutores retrieved successfully');
    }

    /**
     * Update the specified Condutores in storage.
     * PUT/PATCH /condutores/{id}
     */
    public function update($id, UpdateCondutoresAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Condutores $condutores */
        $condutores = $this->condutoresRepository->find($id);

        if (empty($condutores)) {
            return $this->sendError('Condutores not found');
        }

        $condutores = $this->condutoresRepository->update($input, $id);

        return $this->sendResponse($condutores->toArray(), 'Condutores updated successfully');
    }

    /**
     * Remove the specified Condutores from storage.
     * DELETE /condutores/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Condutores $condutores */
        $condutores = $this->condutoresRepository->find($id);

        if (empty($condutores)) {
            return $this->sendError('Condutores not found');
        }

        $condutores->delete();

        return $this->sendSuccess('Condutores deleted successfully');
    }
}
