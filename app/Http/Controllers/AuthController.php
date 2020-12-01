<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function cpSignIn(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
            'rememberMe' => 'boolean'
        ]);
        if($validator->fails()){
            return response(['errors'=>$validator->errors()->all()],422);
        }

        $mUser = User::where('email', $request['email'])->first();
        if($mUser){
            if(Hash::check($request['password'], $mUser->password)){
                $tokenObj = $mUser->createToken('Emerald Tours User');
                if($request['rememberMe']){
                    $tokenObj->token->expires_at = Carbon::now()->addWeeks(1);
                }
                $tokenObj->token->save();
                return response([
                    'access_token'=>$tokenObj->accessToken,
                    // 'refresh_token'=>$tokenObj->refreshToken,
                    'token_type'=>'Bearer',
                    'expires_at'=>Carbon::parse($tokenObj->token->expires_at)->toDateTimeString()
                ],200);
            }
            else{
                return response(['message'=>'Password mismatch'],422);
            }
        }
        else{
            return response(['message'=> 'User does not exist'],422);
        }
    }

    public function cpSignUp(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                // 'regex:/[a-z]/',
                // 'regex:/[A-Z]/',
                // 'regex:/[0-9]/',
                // 'regex:/[@$!%*#?&]/',
                'confirmed'
            ],
            'password_confirmation' => 'same:password',
            'address' => 'required|string'
        ]);
        if($validator->fails()){
            return response([
                'errors' => $validator->failed()
            ],422);
        }
        $request['password'] = Hash::make($request['password']);
        $request['rememberToken'] = Str::random(10);
        $mUser = User::create($request->toArray());
        $token = $mUser->createToken('Emerald Tours User')->accessToken;
        return response(['token'=>$token],200);
    }

    public function cpSignOut(Request $request){
        return response(['message'=>'You have been successfully logged out.'],200);
        // $request->user()->token()->revoke();
        // return response(['message'=>'You have been successfully logged out.'],200);
    }
}
