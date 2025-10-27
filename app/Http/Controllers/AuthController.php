<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

use App\Models\MemberStatus;
use App\Models\Member;
use App\Models\MemberProfileImage;
use App\Models\MemberProfilePrefix;
use App\Models\MemberBirthday;

class AuthController extends Controller
{

    public function checkRequestFormRegister (Request $request) {
        try {

            $validate = $request->validate([
                'email' => '',
                'username' => '',
                'password' => '',
                'passwordConfig' => '',
            ]);

            if (!empty($validate)) {
                return response()->json('validate not null');
            }

            return response()->json('validate null');

        } catch (\Exception $e) {
            return response()->json('function error', $e->getMessage());
        }
    }

    public function register (Request $request) {
        try {

            $validate = $request->validate([
                'email' => [
                    'required',
                    'string',
                    'min:5',
                    'max:100',
                    'unique:users,email'
                ],
                'username' => [
                    'required',
                    'string',
                    'min:5',
                    'max:100',
                    'unique:users,username'
                ],
                'password' => [
                    'required',
                    'string',
                    Password::min(5)
                        ->max(50)
                        ->letters() // ต้องมี ตัวอักษร (a-z A-Z)
                        ->numbers() // ต้องมี ตัวเลข
                    // ->symbols() // ต้องมี สัญลักษณ์พิเศษ
                    // ->uncompromised()
                ],
            ], [
                'email.unique' => 'Email already exists.',
                'username.unique' => 'Username already exists.',
                'password.min' => 'Password must be at least 5 characters.',
                'password.max' => 'Password may not be greater than 50 characters.',
                'password.letters' => 'Password must contain at least one letter.',
                'password.numbers' => 'Password must contain at least one number.',
            ]);

            if (!empty($request->all())) {

                DB::beginTransaction();

                $token = $request->email;

                DB::commit();

                if ($token) {
                    return response()->json([
                        'message' => 'request not null success',
                        'token' => $token,
                        'data' => $request->all()
                    ], 200);
                }

                $data = [
                    $token,
                    $request->all()
                ];

                dd($data);
            }

            return response()->json([
                'message' => 'request false data null',
                'data' => $request->all()
            ], 400);


        } catch (\Exception $e) {
            return response()->json('function error', $e->getMessage());
        }
    }

    public function login (Request $request) {
        try {

            $validate = $request->validate([
                'emailUsername' => 'required|string|min:5|max:100',
                'password' => 'required|string|min:1|max:100'
            ], [
                'emailUsername.required' => 'email or username input request config false',
                'password.required' => 'password input request config false'
            ]);

            if (empty($validate)) {
                return response()->json('validate requert false', 400);
            }

            return response()->json([
                'message' => 'validate request true',
                'data' => $request->all()
            ], 200);


        } catch (\Exception $e) {
            return response()->json('function error', $e->getMessage());
        }
    }

    public function logout (Request $request) {
        try {

            if (empty($request->user())) {
                return response()->json([
                    'message' => 'request user null or false',
                    'user' => $request->all(),
                ], 400);
            }

            $request->user()->tokens()->delete();

            return response()->json([
                'message' => 'request user delete token success'
            ], 200);

        } catch (\Exception $e) {
            return response()->json('function error', $e->getMessage());
        }
    }

}
