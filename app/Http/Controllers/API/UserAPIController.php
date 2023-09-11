<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Models\User;
use App\Repositories\UserRepository;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB as FacadesDB;
// use Intervention\Image\ImageManagerStatic as Image;
// use Kreait\Firebase\Auth as FirebaseAuth;
// use Kreait\Firebase\Auth\SignInResult\SignInResult;
// use Kreait\Firebase\Exception\FirebaseException;

class UserAPIController extends AppBaseController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $data = User::where('nome', 'LIKE', "$keyword%")
                ->orWhere('endereco', 'LIKE', "$keyword%")
                ->paginate(10)
                ->orderBy('nome', 'asc')
                ->with('roles')
                ->get();
        } else {
            $data = User::with('roles')->paginate(10);
        }

        return $this->sendResponse($data, 'Usuários recuperados com sucesso');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:c_password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = $this->userRepository->create($input);
        $user->assignRole($request->input('roles'));

        return $this->sendResponse($user->toArray(), 'Usuário salvo com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $user->getRoleNames();

        if (empty($user)) {
            return $this->sendError('Usuario não encontrado');
        }
        return $this->sendResponse($user->toArray(), 'Usuário recuperado com sucesso');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|same:c_password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('Usuário não encontrado');
        }

        $user->update($input);

        FacadesDB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return $this->sendResponse($input['password'], 'Usuário atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('Usuário not found');
        }

        $user->delete();

        return $this->sendSuccess('Usuário excluído com sucesso');
    }

    public function applyRoleToUser(Request $request, $id)
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            return $this->sendError('Usuário not found');
        }

        $roles = $request->input('roles');


        $user->syncRoles($roles);

        return $this->sendSuccess($user->toArray(), 'Usuário excluído com sucesso');
    }
}
