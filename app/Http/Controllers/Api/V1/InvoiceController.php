<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Model\Invoice;
use App\Model\Order;
use App\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function invoiceDetail(Request $request)
    {
        try
        {

            $user = auth('user-api')->user();
    
            if (!$user) 
            {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'User not authenticated',
                ], 401);
            }


            $invoiceid = $request->input('invoice_id');
            if(!$request->has('invoice_id'))
            {
                return response()->json(['error' => 'Invoice not found'], 404);
            }

            
            $invoice = Invoice::find($invoiceid);
            if (!$invoice) {
                return response()->json(['error' => 'Invoice not found'], 404);
            }
            

            $order = Order::find($invoice->order_id);
            $user = User::find($invoice->user_id);
            $data = [
                'invoice' => $invoice,
                'order' => $order,
                'user' => $user,
            ];

            return response()->json($data);

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
