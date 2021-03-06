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

    private function sendEmail($email, $firstName, $userId, $hash): void
    {
        Mail::to($email)
            ->send(new ActivateAccount(
                $firstName,
                $userId,
                $hash
            )
        );
    }
}
