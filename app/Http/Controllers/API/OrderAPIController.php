<?php

namespace App\Http\Controllers\API;

use JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\{
    Order,
    OrderSchedule,
    User
};
use Illuminate\Http\Request;

class OrderAPIController extends Controller
{
    public function get(): ?object
    {
        try {
            $token = JWTAuth::parseToken();
            $user = User::find($token->getPayload()->get('sub'));
            if ($user->type == "Consumer") {
                $orders = Order::with('product.seller')
                    ->where('user_id', $token->getPayload()->get('sub'))
                    ->orderBy('created_at', 'DESC')
                    ->get();
            } else {
                $orders = User::where('id', $token->getPayload()->get('sub'))
                    ->with('productOrders.orders')
                    ->select([
                        'id'
                    ])
                    ->first();
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $orders
            ], 
            200
        );
    }

    public function query(Order $order): ?object
    {
        try {
            $order->load('product.seller');
            $order->load('orderSchedules');
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $order
            ], 
            200
        );
    }

    public function create(Request $request): ?object
    {
        try {
            $token = JWTAuth::parseToken();
            $order = new Order;
            $order->user_id = $token->getPayload()->get('sub');
            $order->fill($request->except('order_schedules'));
            $order->save();

            $orderSchedules = json_decode(json_encode($request->input('order_schedules')), true);
            foreach ($orderSchedules as $schedule) {
                $orderSchedule = new OrderSchedule;
                $orderSchedule->order_id = $order->id;
                $orderSchedule->schedule_date = $schedule['schedule_date'];
                $orderSchedule->schedule_time = $schedule['schedule_time'];
                $orderSchedule->qty = $schedule['qty'];
                $orderSchedule->total_amount = $schedule['total_amount'];
                $orderSchedule->save();
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $order
            ], 
            201
        );
    }

    public function update(Order $order, Request $request): ?object
    {
        try {
            $order->fill($request->all());
            $order->save();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $order
            ], 
            200
        );
    }

    public function delete(Order $order): ?object
    {
        try {
            $order->delete();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'message' => "Order deleted successful."
            ], 
            200
        );
    }
}
