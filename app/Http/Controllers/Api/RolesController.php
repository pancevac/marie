<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateRoleRequest;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    /**
     * method used to return lists of Role model
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(){
        $roles = Role::orderBy('id', 'DESC')->paginate(50);

        return response([
            'roles' => $roles,
        ], 200);
    }

    /**
     * method used to store new Role model
     *
     * @param CreateRoleRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(CreateRoleRequest $request){
        $role = Role::create(request()->all());

        return response([
            'role' => $role,
        ], 200);
    }

    /**
     * method used to return Role model
     *
     * @param Role $role
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function show(Role $role){
        return response([
            'role' => $role,
        ], 200);
    }

    /**
     * method used to update Role model
     *
     * @param CreateRoleRequest $request
     * @param Role $role
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(CreateRoleRequest $request, Role $role){
        $role->update(request()->all());

        return response([
            'role' => $role,
        ], 200);
    }

    /**
     * method used to destroy Role model
     *
     * @param Role $role
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function destroy(Role $role){
        $role->delete();

        return response([
            'message' => 'Role is deleted',
        ], 200);
    }

    /**
     * method used to return list of roles
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        $roles = Role::select('id', 'name as title')->visible()->orderBy('created_at', 'DESC')->get();

        return response()->json([
            'roles' => $roles,
            'lists' => $roles->pluck('title', 'id'),
        ]);
    }
}
