<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;

class UserController extends Controller
{

    public function updateProfile(Request $request) {
        $user = Auth::user();
        $status = "error";
        $message = "";
        $data = null;
        $code = 200;

        if($user) {
            $this->validate($request, [
                'name' => 'required|string|min:5|max:100',
                'address' => 'required|string|min:20|max:200',
                'phone' => 'required|digits_between:10,12',
                'province_id' => 'required',
                'city_id' => 'required',
            ]);
            $user->name = $request->name;
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->province_id = $request->province_id;
            $user->city_id = $request->city_id;

            if($request->file('avatar')) {
                if($user->avatar && file_exists(storage_path('app/public/'.$user->avatar))) {
                    \Storage::delete('public/'.$user->avatar);
                }
                $file = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = $file;
            }

            if($user->save()) {
                $status = "success";
                $message = "Update profile success";
                $data = $user->toArray();
            } else {
                $message = "Update profile failed";
            }
        } else {
            $message = "User not found";
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function updatePassword(Request $request) {
        $user = Auth::user();
        $status = "error";
        $message = "";
        $data = null;
        $code = 406;

        if($user) {
            $this->validate($request, [
                'password_confirmation' => 'same:new_password',
            ]);

            if(Hash::check($request->current_password, $user->password)) {
                $user->password = Hash::make($request->new_password);

                if($user->save()) {
                    $status = "success";
                    $message = "Update password success";
                    $data = $user->toArray();
                    $code = 200;
                } else {
                    $message = "Update password failed";
                }
            } else {
                $message = "Current password is not match";
            }
        } else {
            $message = "User not found";
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
