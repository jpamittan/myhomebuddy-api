<?php

namespace App\Http\Controllers\API;

use Hash;
use App\Mail\ActivateAccount;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegistrationAPIController extends Controller
{
    public function consumer(Request $request): ?object
    {
        try {
            $consumer = User::where('email', '=', $request->input('email'))
                ->count();
            if ($consumer) {
                return response()->json(['error' => "Email address already registered."], 409);
            }
            $consumer = new User;
            $consumer->first_name = $request->input('first_name');
            $consumer->middle_name = $request->input('middle_name');
            $consumer->last_name = $request->input('last_name');
            $consumer->email = $request->input('email');
            $consumer->password = Hash::make($request->input('password'));
            $consumer->type = "Consumer";
            $properties = [
                "birthdate" => [
                    "month" => $request->input('birthdate_month'),
                    "day" => $request->input('birthdate_day'),
                    "year" => $request->input('birthdate_year')
                ],
                "gender" => $request->input('gender'),
                "address" => [
                    "unit" => $request->input('address_unit'),
                    "subdivision" => $request->input('address_subdivision'),
                    "street" => $request->input('address_street'),
                    "barangay" => $request->input('address_barangay'),
                    "city" => $request->input('address_city'),
                    "zip" => $request->input('address_zip'),
                ],
                "phone_no" => $request->input('phone_no')
            ];
            $consumer->properties = json_encode($properties);
            if ($consumer->save()) {
                $this->sendEmail(
                    $consumer->type,
                    $consumer->email,
                    $consumer->first_name,
                    $consumer->id,
                    md5($consumer->last_name)
                );
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $consumer
            ], 
            201
        );
    }

    public function seller(Request $request): ?object
    {
        try {
            $sellers = User::where('properties', 'LIKE', '%"name":"' . $request->input('business_name') . '"%')
                ->orWhere('properties', 'LIKE', '%"permit_no":"' . $request->input('business_permit_no') . '"%')
                ->orWhere('email', '=', $request->input('email'))
                ->count();
            if ($sellers) {
                return response()->json(['error' => "Email or Business name / permit already registered."], 409);
            }
            $seller = new User;
            $seller->first_name = $request->input('first_name');
            $seller->middle_name = $request->input('middle_name');
            $seller->last_name = $request->input('last_name');
            $seller->email = $request->input('email');
            $seller->password = Hash::make($request->input('password'));
            $seller->type = "Seller";
            $properties = [
                "business" => [
                    "name" => $request->input('business_name'),
                    "permit_no" => $request->input('business_permit_no'),
                    "product" => $request->input('business_product_no'),
                    "images" => [
                        "permit_proof" => $request->input('business_permit_proof'),
                        "owner_valid_id" => $request->input('business_owner_valid_id'),
                        "owner_selfie" => $request->input('business_owner_selfie')
                    ]
                ],
                "birthdate" => [
                    "month" => $request->input('birthdate_month'),
                    "day" => $request->input('birthdate_day'),
                    "year" => $request->input('birthdate_year')
                ],
                "gender" => $request->input('gender'),
                "address" => [
                    "unit" => $request->input('address_unit'),
                    "street" => $request->input('address_street'),
                    "barangay" => $request->input('address_barangay'),
                    "city" => $request->input('address_city'),
                    "zip" => $request->input('address_zip'),
                ],
                "phone_no" => $request->input('phone_no'),
                "mobile_no" => $request->input('mobile_no')
            ];
            $seller->properties = json_encode($properties);
            if ($seller->save()) {
                $this->sendEmail(
                    $seller->type,
                    $seller->email,
                    $seller->first_name,
                    $seller->id,
                    md5($seller->last_name)
                );
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
                'data' => $seller
            ], 
            201
        );
    }

    private function sendEmail(
        string $type, 
        string $email, 
        string $firstName, 
        string $userId, 
        string $hash
    ): void
    {
        Mail::to($email)
            ->send(
                new ActivateAccount(
                    $type,
                    $firstName,
                    $userId,
                    $hash
                )
            );
    }
}
