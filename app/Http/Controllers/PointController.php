<?php

namespace App\Http\Controllers;

use App\Point;
use Illuminate\Http\Request;

class PointController extends Controller
{
    public function addPoint(Request $request, $id) {
        $point = Point::whereId($id)->first();

        if ($point) {

            $validation = $request->validate([
                'new_point' => 'required|numeric|regex:/^[0-9]+$/',
            ]);

            $point->total_point = $point->total_point + $request->new_point;
            $point->save();

            return response()->json([
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
}
