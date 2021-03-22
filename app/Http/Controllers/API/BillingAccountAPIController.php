<?php

namespace App\Http\Controllers\API;

use JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\BillingAccount;
use Illuminate\Http\Request;

class BillingAccountAPIController extends Controller
{
    public function get(): ?object
    {
        try {
            $token = JWTAuth::parseToken();
            $billingAccount = BillingAccount::where(
                    'user_id', 
                    $token->getPayload()->get('sub')
                )
                ->first();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $billingAccount
            ], 
            200
        );
    }

    public function create(Request $request): ?object
    {
        try {
            $token = JWTAuth::parseToken();
            $billingAccount = BillingAccount::updateOrCreate(
                ['user_id' => $token->getPayload()->get('sub')],
                [
                    'account_type' => $request->input('account_type'),
                    'card_no' => $request->input('card_no'),
                    'mm' => $request->input('mm'),
                    'yy' => $request->input('yy'),
                    'cvc' => $request->input('cvc'),
                    'account_name' => $request->input('account_name'),
                    'address_line_a' => $request->input('address_line_a'),
                    'address_line_b' => $request->input('address_line_b'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'zip' => $request->input('zip'),
                    'country' => $request->input('country')
                ]
            );
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $billingAccount
            ], 
            201
        );
    }
}
