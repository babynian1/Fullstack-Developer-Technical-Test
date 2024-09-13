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

    private function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'data'    => $result,
            'message' => $message,
        ];

        if($code == 200)
        {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
       

        return response()->json($response, $code);
    }

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

            return $this->sendResponse(
                $validator->errors(), 
                'Terjadi Kesalahan!, Silahkan coba lagi!', 
                402 
            );       
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
                'data' => $user,
                'access_token' => $token, 
                'token_type' => 'Bearer',
            ];
    
            $response = $this->sendResponse($datas, 'Berhasil', 200);

        } catch (\Throwable $th) {

            $response = $this->sendResponse($th, 'Terjadi Kesalahan Hubungi Administrator', 500);
        }

        
        return $response;
    }


    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('username', 'password')))
        {
            return $this->sendResponse(null, 'Username atau Password Salah', 401 );
        }

        try {
            $user = User::where('username', $request['username'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            $user->remember_token = $token;

            $user->save();
    
            $datas = [
                'access_token' => $token,
                'token_type' => 'Bearer'
            ];
    
            $response = $this->sendResponse($datas, 'Hi '.$user->name, 200);
        } catch (\Throwable $th) {

            $response = $this->sendResponse($th, 'Terjadi Kesalahan Hubungi Administrator', 500);
        } 

        return $response;
    }


    public function logout()
    {
        try {
            $token = auth('sanctum')->check();

            if($token){
                auth()->user()->tokens()->delete();

    
                $response = $this->sendResponse(null, 'Berhasil Logout', 200);
            }
            else {
                $response = $this->sendResponse(null, 'Silahkan login terlebih dahulu', 401);
            }
        } catch (\Throwable $th) {
            
            $response = $this->sendResponse($th, 'Terjadi Kesalahan Hubungi Administrator', 500);
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
            
            $response = $this->sendResponse($th, 'Terjadi Kesalahan Hubungi Administrator', 500);
        } 

        return $response; 
    }
}
