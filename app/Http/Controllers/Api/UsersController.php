<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    /**
     * method used to show users paginate by 50
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $users = User::orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'users' => $users,
        ]);
    }

    /**
     * method used to store new user and return
     *
     * @param CreateUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUserRequest $request){
        $user = User::create($request->except('image'));
        $user->update(['image' => $user->storeImage()]);
        request('role_ids')? $user->role()->sync(explode(',', request('role_ids'))) : $user->role()->sync([]);

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * method used to return user
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user){
        return response()->json([
            'user' => $user,
            'roles' => Role::select('id', 'name as title')->visible()->orderBy('created_at', 'DESC')->get(),
            'role_ids' => $user->role()->get(['name as title', 'id']),
        ]);
    }

    /**
     * method used to update user and return
     *
     * @param EditUserRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EditUserRequest $request, User $user){
        $user->update($request->except('image'));
        $user->update(['image' => $user->storeImage()]);
        request('role_ids')? $user->role()->sync(explode(',', request('role_ids'))) : $user->role()->sync([]);

        return response()->json([
            'user' => $user,
            'role_ids' => $user->role()->get(['name as title', 'id']),
        ]);
    }

    /**
     * method used to destroy user
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user){
        $user->delete();

        return response()->json([
            'message' => 'deleted',
        ]);
    }

    /**
     * method used to change user password
     *
     * @param ChangePasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request){
        $user = $request->user();
        if (Hash::check(request('oldpassword'), $user->password)) {
            $user->update(['password' => request('password'), 'image' => $user->storeImage()]);

            return response()->json([
                'user' => $user,
            ]);
        }else{
            return response()->json([
                'errors' => [
                    'oldpassword' => [
                        0 => 'the old password mismatch',
                    ]
                ]
            ], 422);
        }
    }
}
