<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()->whereHas('roles', function ($query) {
            return $query->where('name','!=', __('roles.admin'));
        })->get();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $userData = $request->safe()->only('name', 'email', 'password');
        $roleId = $request->input('role_id');


        $user = User::query()->create($userData);

        $user->assignRole($roleId);

        return UserResource::make($user)->additional([
            'message' =>  'User Created successfully'
        ])->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return UserResource::make($user)->additional([
            'message' =>  'User Showed successfully'
        ])->response()->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $userData = $request->safe()->only('name', 'email');
        $roleId = $request->input('role_id');

        if ($request->password) {
            $userData['password'] = $request->password;
        }

        $user->update($userData);

        $user->syncRoles($roleId);

        return UserResource::make($user)->additional([
            'message' =>  'User Updated successfully'
        ])->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->delete();
        return response([
            'message'  => 'User deleted successfully',
        ],Response::HTTP_OK);
    }
}
