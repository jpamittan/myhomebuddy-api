<?php

namespace App\Http\Controllers\API;

use JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\{
    Product,
    ProductReview
};
use Illuminate\Http\Request;

class ReviewProductAPIController extends Controller
{
    public function create(Request $request): ?object
    {
        try {
            $token = JWTAuth::parseToken();
            $productReview = ProductReview::updateOrCreate(
                ['user_id' => $token->getPayload()->get('sub')],
                [
                    'product_id' => $request->input('product_id'),
                    'ratings' => $request->input('ratings'),
                    'message' => $request->input('message')
                ]
            );
            $avgRating = ProductReview::where('product_id', $request->input('product_id'))
                ->avg('ratings');
            $product = Product::find($request->input('product_id'));
            $product->ratings = $avgRating;
            $product->save();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $productReview
            ], 
            201
        );
    }
}
