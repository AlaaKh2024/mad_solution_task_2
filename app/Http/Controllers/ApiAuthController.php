<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AppEventsEmailVerificationEvent;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use App\Http\Resources\UserResource;
class ApiAuthController extends Controller
{

    use HttpResponses;

   public function register(UserRegisterRequest $request)
   {

       event(new EmailVerificationEvent($user, $user->verification_code));
       $user = new User;
       $user->email = $request->email;
       $user->phone_number = $request->phone_number;
       $user->username = $request->username;
       $user->password = Hash::make($request->password);
       $user->profile_photo_path = $request->profile_photo->store('profile_photos', 'public');
       $user->certificate_path = $request->certificate->store('certificates', 'public');
       $user->verification_code = Str::random(6);
       $user->save();

        return $this->success([], 'User registered successfully! Please check your email for verification code.');
   }

    public function login(LoginRequest $request)
    {

        if(!Auth::attempt($request->only('email', 'password'))){
            return response([
                'error' => 'The Provided credentials does not match'
            ], 422);
        }

        $user = User::where('email',$request->email)->first();

        return $this->success([
            'user' => new UserResource($user),
            'token' => $user->createToken('API token of '.$user->name)->plainTextToken
        ]);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return $this->success([], 'goodbye...');
    }


    public function refreshToken()
    {

        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('new-token-name');

        return response()->json(['token' => $token->plainTextToken]);
    }

}


