<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use App\Models\User;
class UserController extends Controller
{ public function profile(Request $request)
    {
    $user = Auth::user();

    if ($request->expectsJson()) {
        return response()->json([
            'message' => 'Display profile successfully',
            'data' => new UserResource($user)
        ]);
    }
}



}