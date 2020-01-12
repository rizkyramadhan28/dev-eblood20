<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Point;

class UserController extends Controller
{
    public function new(Request $request) {
        $validation = $request->validate([
            'name' => 'required|min:5|max:255',
            'email' => 'required|unique:users|email|max:255',
            "password" => "required|min:6|max:255",
            "blood_type" => "required|max:255",
            "address" => "required|max:255",
            "phone_number" => "required|digits:12",
        ]);

        if ($validation) {
            $user = User::create($request->all());

            $point = new Point;
            $point->user_id = $user->id;
            $point->total_point = 0;
            $point->save();

            return response()->json([
                "user" => $user,
                "point" => $point,
                "status" => "Success",
                "success" => true
            ], 200);
        }

        return response()->json([
            "validation" => $validation,
            "status" => "Failed",
            "success" => false
        ], 400);
    }

    public function get(Request $request, $id) {
        $user = User::whereId($id)->first();

        if ($user) {
            $point = Point::where("user_id", $id)->first();

            return response()->json([
                "user" => $user,
                "point" => $point,
                "status" => "Success",
                "success" => true
            ], 200);
        }

        return response()->json([
            "status" => "Failed",
            "success" => false
        ], 400);
    }

    public function update(Request $request, $id) {
        $user = User::whereId($id)->first();

        if ($user) {
            $validation = $request->validate([
                'name' => 'min:5|max:255',
                'email' => 'email|max:255|unique:users,email,'.$user->id,
                "password" => "min:6|max:255",
                "blood_type" => "min:1|max:255",
                "address" => "min:6|max:255",
                "phone_number" => "digits:12",
            ]);

            if ($validation) {
                if ($user) {
                    $user->update($request->all());
    
                    return response()->json([
                        "status" => "Success",
                        "success" => true
                    ], 200);
                }
            }
        }

        return response()->json([
            "status" => "Failed",
            "success" => false
        ], 400);
    }

    public function delete($id) {
        $user = User::whereId($id)->first();

        if ($user) {
            $point = Point::where("user_id", $id)->first();

            $user->delete();
            $point->delete();

            return response()->json([
                "status" => "Success",
                "success" => true
            ], 200);
        }

        return response()->json([
            "status" => "Failed",
            "success" => false
        ], 400);
    }
}
