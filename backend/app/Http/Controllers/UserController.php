<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Str;

class UserController extends Controller
{ 
    public function store(Request $request)
    {
        try {
            DB::connection('mysql')->beginTransaction();

            $name = $request->firstname . $request->lastname;
            $user = User::updateOrcreate(
                [
                    'name' => $name,
                    'email' => $request->email,
                    'username' => $request->username
                ],
                [
                    'username' => $request->username,
                    'name' => $name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'number' => $request->mobile,
                    'status' => 1,
                    'role_id' => 3,
                    'api_token' => Str::random(60),

                ]
            );
            $user->details()->updateOrCreate(
                [
                    'user_id' => $user->id,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,

                ],
                [
                    'user_id' => $user->id,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'number' => $request->mobile,
                    'email' => $request->email,
                    'status' => 1,
                ]
            );
            $data = User::with('details')->where('id', $user->id)->first();
            DB::connection('mysql')->commit();
            return response()->json(['msg' => 'save succesfully', 'user' => $data, 'token' => $user->api_token], 201);
        } catch (\Exception $e) {
            DB::connection('mysql')->rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
