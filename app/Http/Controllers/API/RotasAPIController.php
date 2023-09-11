<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRotasAPIRequest;
use App\Http\Requests\API\UpdateRotasAPIRequest;
use App\Models\Rotas;
use App\Repositories\RotasRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class RotasAPIController
 */
class RotasAPIController extends AppBaseController
{
    private RotasRepository $rotasRepository;

    public function __construct(RotasRepository $rotasRepo)
    {
        $this->rotasRepository = $rotasRepo;
    }

    /**
     * Display a listing of the Rotas.
     * GET|HEAD /rotas
     */
    public function index(Request $request): JsonResponse
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data = Rotas::where('turno_matutino', 'LIKE', "$keyword%")
                ->orWhere('turno_vespertino', 'LIKE', "$keyword%")
                ->orWhere('turno_noturno', 'LIKE', "$keyword%")
                ->paginate(10)
                ->orderBy('nome', 'asc')
                ->get();
        } else {
            $data = $this->rotasRepository->paginate(10);
        }


        return $this->sendResponse($data->toArray(), 'Rotas retrieved successfully');
    }

    public function all()
    {
        $rotas = Rotas::orderBy('nome', 'ASC')->get();

        return $this->sendResponse($rotas, 'Rotas recuperadas com sucesso');
    }

    /**
     * Store a newly created Rotas in storage.
     * POST /rotas
     */
    public function store(CreateRotasAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $rotas = $this->rotasRepository->create($input);

        return $this->sendResponse($rotas->toArray(), 'Rotas saved successfully');
    }

    /**
     * Display the specified Rotas.
     * GET|HEAD /rotas/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Rotas $rotas */
        $rotas = $this->rotasRepository->find($id);

        if (empty($rotas)) {
            return $this->sendError('Rotas not found');
        }

        return $this->sendResponse($rotas->toArray(), 'Rotas retrieved successfully');
    }

    /**
     * Update the specified Rotas in storage.
     * PUT/PATCH /rotas/{id}
     */
    public function update($id, UpdateRotasAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Rotas $rotas */
        $rotas = $this->rotasRepository->find($id);

        if (empty($rotas)) {
            return $this->sendError('Rotas not found');
        }

        $rotas = $this->rotasRepository->update($input, $id);

        return $this->sendResponse($rotas->toArray(), 'Rotas updated successfully');
    }

    /**
     * Remove the specified Rotas from storage.
     * DELETE /rotas/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Rotas $rotas */
        $rotas = $this->rotasRepository->find($id);

        if (empty($rotas)) {
            return $this->sendError('Rotas not found');
        }

        $rotas->delete();

        return $this->sendSuccess('Rotas deleted successfully');
    }
}
