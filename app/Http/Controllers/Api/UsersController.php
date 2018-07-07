<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index(){
        $users = User::orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'users' => $users
        ]);
    }

    public function store(CreateUserRequest $request){
        $user = User::create($request->except('image'));

        return response()->json([
            'user' => $user
        ]);
    }

    public function show($id){
        $user = User::find($id);
        return response()->json([
            'user' => $user,
        ]);
    }

    public function update(EditUserRequest $request, $id){
        $user = User::find($id);
        $user->update($request->except('image'));

        return response()->json([
            'user' => $user,
        ]);
    }

    public function destroy($id){
        $user = User::find($id);
        if(!empty($user->image)) File::delete($user->image);
        $user->delete();
        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function uploadImage($id){
        $user = User::find($id);
        $user->update(['image' => $user->storeImage()]);
        return response()->json([
            'image' => $user->image
        ]);
    }

    public function changePassword(ChangePasswordRequest $request){
        $user = $request->user();
        if (Hash::check(request('oldpassword'), $user->password)) {
            $user->password = bcrypt(request('password'));
            $user->update();

            $user->update(['image' => $user->storeImage()]);

            return response()->json([
                'message' => 'done'
            ]);
        }else{
            return response()->json([
                'errors' => [
                    'oldpassword' => [
                        0 => 'the old password mismatch'
                    ]
                ]
            ], 422);
        }
    }
}
