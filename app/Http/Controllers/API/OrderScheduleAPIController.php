<?php

namespace App\Http\Controllers\API;

use JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\OrderSchedule;
use Illuminate\Http\Request;

class OrderScheduleAPIController extends Controller
{
    public function update(OrderSchedule $orderSchedule, Request $request): ?object
    {
        try {
            $orderSchedule->fill($request->all());
            $orderSchedule->save();
            $orderSchedule->delete();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'message' => "Order schedule deleted successful."
            ], 
            200
        );
    }
}
