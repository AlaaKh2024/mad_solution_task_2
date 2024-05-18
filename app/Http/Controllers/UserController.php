<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $user = Auth::user();

        if ($request->expectsJson()) {
            return new UserResource($user);
        } else {
            return view('user.profile');
        }
    }
}
