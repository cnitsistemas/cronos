<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB as FacadesDB;

class PermissionsAPIController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        //  $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        //  $this->middleware('permission:role-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $permission = Permission::where('name', 'LIKE', "$keyword%")
                ->paginate(10)
                ->orderBy('name', 'ASC')
                ->get();
        } else {
            $permission = Permission::orderBy('name', 'ASC')->paginate(10);
        }

        return $this->sendResponse($permission->toArray(), 'Permissões recuperadas com sucesso');
    }

    public function all()
    {
        $permission = Permission::orderBy('name', 'ASC')->get();

        return $this->sendResponse($permission, 'Permissões recuperadas com sucesso');
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
            'permissions' => 'required',
        ]);

        $permissions = $request->input('permissions');

        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'api', 'name' => $permission]);
        }
        return $this->sendResponse($permissions, 'Permissões salvas com sucesso');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::find($id);

        if (empty($permission)) {
            return $this->sendError('Permissão não encontrada');
        }

        return $this->sendResponse($permission, 'Permissão recuperado com sucesso');
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
            'permission' => 'required',
        ]);

        $permission = Role::find($id);

        if (empty($permission)) {
            return $this->sendError('Permissão não encontrado');
        }
        $permission->name = $request->input('name');
        $permission->save();

        return $this->sendResponse($permission->toArray(), 'Permissão atualizada com sucesso');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FacadesDB::table("permissions")->where('id', $id)->delete();
        return $this->sendSuccess('Permissão excluída com sucesso');
    }
}
