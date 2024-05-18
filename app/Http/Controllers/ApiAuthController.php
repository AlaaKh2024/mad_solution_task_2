<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AppEventsEmailVerificationEvent;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
class ApiAuthController extends Controller
{
    


   public function register(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'email' => 'required|email|unique:users,email',
           'phone_number' => 'required|unique:users,phone_number',
           'username' => 'required|unique:users,username',
           'password' => 'required|string|min:6|confirmed',
           'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
           'certificate' => 'required|mimes:pdf|max:10000',
       ]);

       if ($validator->fails()) {
           return response()->json($validator->errors(), 400);
       }

    
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
       Mail::to($user->email)->send(new VerificationMail($user->verification_code));

       return response()->json(['message' => 'User registered successfully! Please check your email for verification code.']);
   }
    

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required','string','email'],
            'password' => ['required','string', 'min:6'],
        ]);

        if(!Auth::attempt($request->only('email', 'password'))){
            return response([
                'error' => 'The Provided credentials does not match'
            ], 422);
        }

        $user = User::where('email',$request->email)->first();

        return response([
            'user' => new UserResource($user),
            'token' => $user->createToken('API token of '.$user->name)->plainTextToken
        ]);
    }
    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response([
            'success' => true,
            'message'=>'goodbye...'
        ]);
    }
    

    public function refreshToken(Request $request)
{

    $request->user()->currentAccessToken()->delete();

    $token = $request->user()->createToken('new-token-name');

    return response()->json(['token' => $token->plainTextToken]);
}

}


