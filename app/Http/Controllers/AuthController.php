<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hash;
use Auth;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', '=', $request->email)->firstOrFail();
        $status = "error";
        $message = "";
        $data = null;
        $code = 401;

        if($user) {
            // jika hasil hash dari password yg diinput user sama dengan password di database user maka
            if(Hash::check($request->password, $user->password)) {
                // generate token
                $user->generateToken();
                $status = 'success';
                $message = 'Login sukses';
                // tampilkan data user menggunakan method toArray
                $data = $user->toArray();
                $code = 200;
            } else {
                $message = "Login gagal, password salah";
            }
        } else {
            $message = "Login gagal, username salah";
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:5|max:100',
            'username' => 'required|string|min:5|max:20|unique:users',
            'email' => 'required|email|max:191|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        $status = "error";
        $message = "";
        $data = null;
        $code = 400;

        if($validator->fails()) {
            $errors = $validator->errors();
            $message = $errors;
        } else {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles' => json_encode(['CUSTOMER']),
            ]);

            if($user) {
                $user->generateToken();
                $status = "success";
                $message = "register successfully";
                $data = $user->toArray();
                $code = 200;
            } else {
                $message = 'register failed';
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function logout(Request $request) {
        $user = Auth::user();
        if($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'logout berhasil',
            'data' => null
        ], 200);
    }

}
