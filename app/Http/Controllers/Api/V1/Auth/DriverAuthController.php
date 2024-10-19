<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Model\DriverEarning;
use Doctrine\DBAL\Query\QueryException;



class DriverAuthController extends Controller
{
    public function loginDriver(Request $request)
    {
        try 
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);

            if ($validator->fails()) 
            {
                return response()->json(['errors' => Helpers::error_processor($validator)], 403);
            }


            $credentials = $request->only('email', 'password');

            if (Auth::guard('driver')->attempt($credentials)) 
            {

                $driver = Auth::guard('driver')->user();
                // Log::info('Authenticated driver:', ['driver' => $driver]);
                // return $driver;
                
                if ($driver)//&& Hash::check($request->password, $driver->password) 
                {
                    $token = $driver->createToken('DriverAuth')->accessToken;
                    $driver->remember_token = $token;
                    $driver->save();

                
                    return response()->json([
                        'token' => $token,
                        'driver' => $driver,
                    ], 200);
                } 
                else 
                {
                    // Log::warning('Password check failed or driver not found.');
                    return response()->json([
                        'errors' => [['code' => 'auth-001', 'message' => 'Unauthorizedd.']]
                    ], 401);
                }
            } 
            else 
            {
                return response()->json([
                    'errors' => [['code' => 'auth-001', 'message' => 'Unauthorized.']]
                ], 401);
            }
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }




    public function viewProfile()
    {
        try 
        {
            
            $driver = auth('driver-api')->user();
            //  return response()->json([
            //     'Driver' => $driver], 200);

            if (!$driver) 
            {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'User not authenticated.',
                ], 401);
            }

            return response()->json($driver);
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'error' => 'An error occurred while fetching data.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    

    public function update(Request $request)
    {

        try 
        {
            
            $driver = auth('driver-api')->user();
            //  return response()->json([
            //     'Driver' => $driver], 200);

    
            
            if (!$driver) 
            {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'User not authenticated.',
                ], 401);
            }
    
           
            $request->validate([
                'f_name' => 'nullable|string|max:255',
                'l_name' => 'nullable|string|max:255',
                'password' => 'nullable|string|min:8', 
            ]);
    
          
            $changedFields = [];


            if ($request->filled('f_name') && $request->input('f_name') !== $driver->f_name) 
            {
                $driver->f_name = $request->input('f_name');
                $changedFields[] = 'f_name';
            }


            if ($request->filled('l_name') && $request->input('l_name') !== $driver->l_name) 
            {
                $driver->l_name = $request->input('l_name');
                $changedFields[] = 'l_name';
            }


            if ($request->filled('password')) 
            {
                $hashedPassword = Hash::make($request->input('password'));
                if ($hashedPassword !== $driver->password) 
                {
                    $driver->password = $hashedPassword;
                    $changedFields[] = 'password';
                }
            }


            if (empty($changedFields)) 
            {
                return response()->json(['message' => 'No new changes'], 200);
            }
    
            $driver->save();
    
            return response()->json([ 
                'message' => 'Driver profile updated successfully',
                'changed_fields' => $changedFields]);
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'error' => 'An error occurred while updating user profile.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }





    public function getLastMonthEarnings()
    {
        
        try
        {
           
            $driver = auth('driver-api')->user();
            //  return response()->json([
            //     'Driver' => $driver], 200);

    
            
            if (!$driver) 
            {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'User not authenticated.',
                ], 401);
            }
    
            $driverId = $driver->id;

            $startDate = Carbon::now()->subMonth()->startOfMonth();
            

            $earningsLastMonth = DriverEarning::where('driver_id', $driverId)->where('created_at', '>=', $startDate)->sum('earning_amount') + DriverEarning::where('driver_id', $driverId)->where('created_at', '>=', $startDate)->sum('tip_amount');

            return response()->json([
                'driver_id' => $driverId,
                'earnings_last_month' => $earningsLastMonth
            ], 200);
        }
        catch (\Exception $e) 
        {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }




    public function getTotalEarnings()
    {
        try
        {
            
            $driver = auth('driver-api')->user();
    
            if (!$driver) 
            {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'User not authenticated',
                ], 401);
            }
            
            // return response()->json([
            // 'Driver' => $driver], 200);
            $driverId = $driver->id;

           
            $totalEarnings = DriverEarning::where('driver_id', $driverId)->sum(DB::raw('earning_amount + tip_amount'));

            return response()->json([
                'driver_id' => $driverId,
                'total_earnings' => $totalEarnings,
            ]);

        }
        catch (\Exception $e) 
        {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }




    public function addEarnings()
    {
        try 
        {
            
            $driver = auth('driver-api')->user();
    
            if (!$driver) 
            {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'User not authenticated',
                ], 401);
            }
            
            // // return response()->json([
            // // 'Driver' => $driver], 200);
            $driverId = $driver->id;
            
            $logMessages = []; 
            $processedOrders = []; 
           

            $driverExists = DB::table('drivers')->where('id', $driverId)->exists();

            if (!$driverExists) 
            {
                return response()->json([
                    'error' => 'Driver not found',
                    'message' => 'Driver with ID ' . $driverId . ' does not exist',
                ], 404);
            }


            $completedOrders = DB::table('orders')->where('driver_id', $driverId)->where('order_status', 'finished')->get();

            if ($completedOrders->count() > 0) {

                foreach ($completedOrders as $order) {

                    $earningAmount = $order->fees / 4; 
                    $tipAmount = $order->Additional_tips;

                    $earningRecord = DB::table('driver_earnings')->where('driver_id', $driverId)->first();

                    if (!$earningRecord) 
                    {
                        $earningRecord = DB::table('driver_earnings')->insert([
                            'driver_id' => $driverId,
                            'earning_amount' => $earningAmount,
                            'tip_amount' => $tipAmount,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $logMessages[] = 'New earnings record created for driver ID: ' . $driverId;
                    } 
                    else 
                    {
                        $earningRecord = DB::table('driver_earnings')
                            ->where('driver_id', $driverId)
                            ->update([
                                'earning_amount' => $earningAmount,
                                'tip_amount' => $tipAmount,
                                'updated_at' => now(),
                            ]);

                        $logMessages[] = 'Earnings record updated for driver ID: ' . $driverId;
                    }

                    $processedOrders[] = [
                        'order_id' => $order->id,
                        'earning_amount' => $earningAmount,
                        'tip_amount' => $tipAmount,
                    ];
                }
            }
            else
            {
                return response()->json([
                    'message' => 'No completed orders found for the specified driver_id.'
                ], 404);
            }

            return response()->json([
                'message' => 'Earnings added successfully',
                'logs' => $logMessages,
                'processed_orders' => $processedOrders, 
            ]);
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage(),
                'logs' => $logMessages,
            ], 500);
        }
    }




    public function listEarnings(Request $request)
{
    try
    {
        
        $driver = auth('driver-api')->user();

        if (!$driver) 
        {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'User not authenticated',
            ], 401);
        }

        $driverId = $driver->id;
        
        $page = $request->input('page', 1);

        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $query = DriverEarning::where('driver_id', $driverId)
            ->orderBy('earning_amount', 'desc')
            ->select('driver_id', 'earning_amount');

        $query->skip($offset);

        $earnings = $query->take($perPage)->get();

        $totalSize = $query->count();

        $paginator = [
            'total_size' => $totalSize,
            'limit' => $perPage,
            'page' => $page,
            'earnings' => $earnings->toArray()
        ];

        return response()->json($paginator);

    }
    catch (QueryException $e) 
    {
        return response()->json([
            'error' => 'An error occurred while fetching data.',
            'message' => $e->getMessage(),
        ], 500);
    }
}




}
