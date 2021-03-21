<?php

namespace App\Http\Controllers\API;

use JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductAPIController extends Controller
{
    public function get(): ?object
    {
        try {
            $products = Product::with('seller')
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')
                // ->paginate(20);
                ->get();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $products
            ], 
            200
        );
    }

    public function fetch(): ?object
    {
        try {
            $token = JWTAuth::parseToken();
            $products = Product::where('status', 1)
                ->where('user_id', $token->getPayload()->get('sub'))
                ->orderBy('created_at', 'DESC')
                // ->paginate(20);
                ->get();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $products
            ], 
            200
        );
    }

    public function create(Request $request): ?object
    {
        try {
            $token = JWTAuth::parseToken();
            $product = new Product;
            $product->user_id = $token->getPayload()->get('sub');
            $product->fill($request->all());
            $product->save();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $product
            ], 
            201
        );
    }

    public function query(Product $product): ?object
    {
        return response()->json([
                'data' => $product
            ], 
            200
        );
    }

    public function update(Product $product, Request $request): ?object
    {
        try {
            $product->fill($request->all());
            $product->save();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $product
            ], 
            201
        );
    }

    public function delete(Product $product): ?object
    {
        try {
            $product->delete();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'message' => "Product deleted successful."
            ], 
            200
        );
    }
}
