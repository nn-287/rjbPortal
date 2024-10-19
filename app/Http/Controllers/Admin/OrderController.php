<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\Order;

class OrderController extends Controller
{
   
    public function list($status = null)
    {
        if ($status === 'all') 
        {
            $orders = Order::paginate(10);
        } 
        else 
        {
            $orders = Order::where('order_status', $status)->paginate(10);
        }
        
        return view('admin-views.order.list', compact('orders'));
    }



    public function details($id)
    {
        $order = Order::with(['driver', 'invoice', 'user'])->findOrFail($id);
        return view('admin-views.order.order-view', compact('order'));
    }



    public function payment_status(Request $request)
    {
        $order = Order::find($request->id);
        $order->payment_status = $request->payment_status;
        $order->save();
        Toastr::success('Payment status updated successfully!');
        return back();
    }



    public function UpdateOrderStatus(Request $request)
    {
        $orderId = $request->input('id');
        $orderStatus = $request->input('order_status');
        $order = Order::findOrFail($orderId);
        $order->order_status = $orderStatus;
        $order->save();
        Toastr::success('Order status updated successfully!');
        return back();
    }


    public function delete_order($id)
    {
        $order = Order::find($id);

        if ($order) 
        {
           
            dd($order->toArray(), $order->invoices->toArray(), $order->invoices()->toSql());

           
            $order->invoices()->delete();
            $order->delete();

            Toastr::success('Order deleted successfully!');
        } 
        else 
        {
            Toastr::error('Order not found!');
        }

        return back();
    }



    public function search(Request $request)
    {
        $key = explode(' ', $request['search']);
        $orders = Order::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('id', 'like', "%{$value}%")
                    ->orWhere('order_status', 'like', "%{$value}%");
            }
        })->get();
        return response()->json([
            'view' => view('admin-views.order.partials._table', compact('orders'))->render()
        ]);
    }
    

}
