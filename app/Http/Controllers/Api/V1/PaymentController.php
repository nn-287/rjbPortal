<?php

namespace App\Http\Controllers\Api\V1;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\BankAccount;



class PaymentController extends Controller
{
    public function requestPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:COD,online',
            'bank_name' => 'required_if:payment_method,online|string',
            'branch' => 'required_if:payment_method,online|string',
            'account_number' => 'required_if:payment_method,online|string',
            'card_type' => 'required_if:payment_method,online|string',
        ]);


        try
        {
            $user = auth('user-api')->user();
    
            if (!$user) 
            {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'Invalid bearer token.',
                ], 401);
            }


            if ($request->payment_method !== 'COD') 
            {
                
                // $response = Http::post('https:', 
                // [
                //     'account_number' => $request->account_number,
                //     'card_type' => $request->card_type,
                // ]);


                //if ($response->successful()) 
                //{
                  
                
                    

                    BankAccount::create([
                        'user_id' => $user->id,
                        'bank_name' => $request->bank_name,
                        'branch' => $request->branch,
                        'account_number' => $request->account_number,
                        'card_type' => $request->card_type,
                        'transaction_time' => $request->transaction_time,
                    ]);
            
                    return response()->json(['message' => 'Online payment successful']);
                //}
                // else 
                // {
                //     return response()->json(['error' => 'Bank account verification failed'], 400);
                // }

            } 
            else 
            {
                return response()->json(['error' => 'COD payments cannot be processed!'], 400);
            }

        }
        catch (\Exception $e) 
        {
            return response()->json([
                'error' => 'An error occurred while processing the payment.',
                'message' => $e->getMessage(),
            ], 500);
        }



        
    }
}
