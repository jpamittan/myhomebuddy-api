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
            $billingAccount = new BillingAccount;
            $billingAccount->user_id = $token->getPayload()->get('sub');
            $billingAccount->fill($request->all());
            $billingAccount->save();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $billingAccount
            ], 
            201
        );
    }

    public function update(BillingAccount $billingAccount, Request $request): ?object
    {
        try {
            $billingAccount->fill($request->all());
            $billingAccount->save();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $billingAccount
            ], 
            200
        );
    }
}
