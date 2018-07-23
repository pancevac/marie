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
        $roles = Role::sort();

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
}
