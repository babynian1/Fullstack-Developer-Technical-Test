<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use Validator;
use App\Models\User;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $datas = [];
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()){
            $datas = [
                'success' => false,
                'message' => 'Terjadi Kesalahan!, Silahkan coba lagi!',
                'data' => $validator->errors()
            ];

            return response()->json($datas, 402);       
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'username'=> $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            $datas = [
                'message'=> 'Berhasil!',
                'data' => $user,
                'access_token' => $token, 
                'success'=> true,
                'token_type' => 'Bearer',
            ];
    
            $response = response()
                ->json($datas, 200);

        } catch (\Throwable $th) {
            
            $datas = [
                'message'=> 'Terjadi Kesalahan Hubungi Administrator',
                'data' => $th,
                'success'=> false,
            ];

            $response = response()
            ->json($datas, 500);
        }

        
        return $response;
    }


    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password')))
        {
            $datas = [
                'message' => 'Username atau Password Salah',
                'success' => false
            ];

            return response()
                ->json($datas, 401);
        }

        try {
            $user = User::where('username', $request['username'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            $user->remember_token = $token;

            $user->save();
    
            $datas = [
                'message' => 'Hi '.$user->name,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'success' => true
            ];
    
            $response = response()->json($datas,200);
        } catch (\Throwable $th) {
            
            $datas = [
                'message'=> 'Terjadi Kesalahan Hubungi Administrator',
                'data' => $th,
                'success'=> false,
            ];

            $response = response()
            ->json($datas, 500);
        } 

        return $response;
    }


    public function logout()
    {
        try {
            $token = auth('sanctum')->check();

            if($token){
                auth()->user()->tokens()->delete();

                $datas = [
                    'message' => 'Berhasil log out',
                    'success' => true,
                ];
    
                $response = response()->json($datas,200);
            }
            else {
                $datas = [
                    'message' => 'silahkan login terlebih dahulu!',
                    'success' => false,
                ];

                $response = response()->json($datas, 401);
            }
        } catch (\Throwable $th) {
            
            $datas = [
                'message'=> 'Terjadi Kesalahan Hubungi Administrator',
                'data' => $th,
                'success'=> false,
            ];

            $response = response()->json($datas, 500);
        } 

        return $response;
    }


    public function profile()
    {
        try {

            $token = auth('sanctum')->check();

            if($token) {
                $user = auth()->user();

                $datas = [
                    'message' => 'Berhasil',
                    'success' => true,
                    'data' => $user
                ];
                $response = response()->json($datas, 200);
               
            } else {
                $datas = [
                    'message' => 'silahkan login terlebih dahulu!',
                    'success' => false,
                ];

                $response = response()->json($datas, 401);
            }

           

        } catch (\Throwable $th) {
            
            $datas = [
                'message'=> 'Terjadi Kesalahan Hubungi Administrator',
                'data' => $th,
                'success'=> false,
            ];

            $response = response()->json($datas, 500);
        } 

        return $response; 
    }
}
