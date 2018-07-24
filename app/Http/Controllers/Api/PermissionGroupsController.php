<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreatePermissionGroupRequest;
use App\PermissionGroup;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionGroupsController extends Controller
{
    /**
     * method used to return lists of PermissionGroup model
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index(){
        $permission_groups = PermissionGroup::with('permission')->orderBy('id', 'DESC')->paginate(PermissionGroup::$paginate);

        return response([
            'permission_groups' => $permission_groups,
        ], 200);
    }

    /**
     * method used to store new PermissionGroup model
     *
     * @param CreatePermissionGroupRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(CreatePermissionGroupRequest $request){
        $permission_group = PermissionGroup::create(request()->all());

        return response([
            'permission_group' => $permission_group,
        ], 200);
    }

    /**
     * method used to return PermissionGroup model
     *
     * @param PermissionGroup $permission_group
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function show(PermissionGroup $permission_group){
        return response([
            'permission_group' => $permission_group,
        ], 200);
    }

    /**
     * method used to update PermissionGroup model
     *
     * @param CreatePermissionGroupRequest $request
     * @param PermissionGroup $permission_group
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function update(CreatePermissionGroupRequest $request, PermissionGroup $permission_group){
        $permission_group->update(request()->all());

        return response([
            'permission_group' => $permission_group,
        ], 200);
    }

    /**
     * method used to destroy PermissionGroup model
     *
     * @param PermissionGroup $permission_group
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function destroy(PermissionGroup $permission_group){
        $permission_group->delete();

        return response([
            'message' => 'Role is deleted',
        ], 200);
    }

    /**
     * method used to return list of permission_groups
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function lists(){
        return response()->json([
            'permission_groups' => $permission_groups = PermissionGroup::with('permission')->visible()->orderBy('created_at', 'DESC')->get(),
            'role' => $role = Role::find(request('role')),
            'permission_ids' => $role->permission()->pluck('id')->toArray(),
        ]);
    }
}
