<?php

namespace App\Http\Controllers\API;

use JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\{
    Order,
    OrderSchedule,
    Product
};
use Illuminate\Http\Request;

class OrderScheduleAPIController extends Controller
{
    public function update(OrderSchedule $orderSchedule, Request $request): ?object
    {
        try {
            if ($request->input('status') == "cancelled") {
                $order = Order::find($orderSchedule->order_id);
                $product = Product::find($order->product_id);
                $product->quantity = $product->quantity + $orderSchedule->qty;
                $product->save();
            }
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
