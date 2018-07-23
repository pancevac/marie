<?php

namespace App\Http\Controllers\Api;

use App\Permission;
use App\PermissionGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePermissionRequest;

class PermissionsController extends Controller
{
    /**
     * method used to return lists of Permission model
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(){
        $permissions = Permission::orderBy('id', 'DESC')->paginate(50);

        return response([
            'permissions' => $permissions,
        ], 200);
    }

    /**
     * method used to store new Permission model
     *
     * @param CreatePermissionRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(CreatePermissionRequest $request){
        $permission = Permission::create(request()->all());

        return response([
            'permission' => $permission,
        ], 200);
    }

    /**
     * method used to return Permission model
     *
     * @param Permission $permission
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function show(Permission $permission){

        return response([
            'permission' => $permission,
        ], 200);
    }

    /**
     * method used to update Permission model
     *
     * @param CreatePermissionRequest $request
     * @param Permission $permission
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(CreatePermissionRequest $request, Permission $permission){
        $permission->update(request()->all());

        return response([
            'permission' => $permission,
        ], 200);
    }

    /**
     * method used to destroy Permission model
     *
     * @param Permission $permission
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function destroy(Permission $permission){
        $permission->delete();

        return response([
            'message' => 'Role is deleted',
        ], 200);
    }
}
