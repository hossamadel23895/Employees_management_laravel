<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function changePassword(ChangePasswordRequest $request)
    {
        if (!Hash::check($request->old_password, Auth::user()->password))
            throw ValidationException::withMessages(['old_password' => 'Invalid old password']);

        if ($request->old_password == $request->new_password )
            throw ValidationException::withMessages([ 'password' => 'The password provided was previously in use.' ]);

        Auth::user()->update(['password' => $request->new_password]);

        return response(['message'  => 'Password changed successfully'],Response::HTTP_OK);
    }
}
