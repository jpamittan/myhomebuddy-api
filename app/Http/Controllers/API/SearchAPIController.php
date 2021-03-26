<?php

namespace App\Http\Controllers\API;

use JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\{
    Product,
    User
};
use Illuminate\Http\Request;

class SearchAPIController extends Controller
{
    public function query(Request $request): ?object
    {
        try {
            $searches = Product::leftJoin('users', 'users.id', '=', 'products.user_id')
                ->where('products.name', 'LIKE', '%' . $request->input('query') . '%')
                ->orWhere('products.description', 'LIKE', '%' . $request->input('query') . '%')
                ->orWhere('users.properties', 'LIKE', '%' . $request->input('query') . '%')
                ->orderByDesc('ratings')
                ->select([
                    'products.id',
                    'products.name',
                    'products.image',
                    'products.ratings',
                    'users.id as user_id',
                    'users.properties'
                ])
                ->get();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $searches
            ], 
            200
        );
    }
}
