<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Model\Order;
use Illuminate\Http\Request;
use App\Model\Delivery;
use App\Model\OrderDetail;


class DeliveryController extends Controller
{
    public function getStatistics()
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
                    'message' => 'User not authenticated',
                ], 401);
            }
            $driverId = $driver->id;
           

           
            $pendingCount = Order::where('driver_id', $driverId)->where('order_status', 'pending')->count();
            $deliveredCount = Order::where('driver_id', $driverId)->where('order_status', 'finished')->count();
            $canceledCount = Order::where('driver_id', $driverId)->where('order_status', 'canceled')->count();

            return response()->json([
                'pending_count' => $pendingCount,
                'delivered_count' => $deliveredCount,
                'canceled_count' => $canceledCount,
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




    public function successfulDeliveries()
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
                    'message' => 'User not authenticated',
                ], 401);
            }
            $driverId = $driver->id;
           

            $successfulDeliveries = DB::table('orders')
                ->join('deliveries', 'orders.id', '=', 'deliveries.order_id')
                ->where('deliveries.driver_id', $driverId)
                ->where('orders.order_status', 'finished')
                ->selectRaw('DATE(deliveries.created_at) as delivery_date, COUNT(*) as total_deliveries')
                ->groupBy('delivery_date')
                ->get();

            return response()->json($successfulDeliveries);
        }
        catch (QueryException $e) 
        {
            return response()->json([
                'error' => 'An error occurred while fetching data.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }




    public function deliveryStatus(Request $request)
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


            $status = $request->input('status');
            if(!$request->has('status'))
            {
                $status = 'pending';

            }
           

            $offset = $request->input('offset', 0);

            $perPage = 10; 
            
            $query = Delivery::query()
                ->join('orders', 'deliveries.order_id', '=', 'orders.id')
                ->where('orders.order_status', $status)
                ->where('deliveries.driver_id', $driverId)
                ->select('deliveries.*')
                ->orderBy('created_at', 'desc');
            
            
            $query->skip($offset * $perPage);
           
            $deliveries = $query->take($perPage)->get();
           
            $totalSize = $query->count();
            
            $paginator = [
                'total_size' => $totalSize,
                'limit' => $perPage,
                'offset' => $offset,
                'deliveries' => $deliveries->toArray() 
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





    public function deliveryDetail()
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
           
    
            $deliveries = Delivery::where('driver_id', $driverId)->get();

           
            if ($deliveries->isEmpty()) 
            {
                return response()->json(['error' => 'Deliveries not found for the driver'], 404);
            }

           
            $orderDetails = [];

            foreach ($deliveries as $delivery) 
            {
                $order = $delivery->order;

                if (!$order) {
                    return response()->json(['error' => 'Order not found for delivery'], 404);
                }

                $details = OrderDetail::where('order_id', $order->id)->get();
                $orderDetails[] = $details;
            }

            if (empty($orderDetails)) 
            {
                return response()->json(['error' => 'Order details not found'], 404);
            }

            return response()->json(['order' => $order, 'order_details' => $orderDetails]);
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
