<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\Delivery;

class DeliveryController extends Controller
{
    public function ListDeliveries()
    {
        $deliveries = Delivery::with(['order', 'driver'])->get();
        return view('admin-views.delivery.list', compact('deliveries'));
    }


    public function RemoveDelivery($id)
    {
        // dd($id);
        $delivery = Delivery::find($id);

        if ($delivery) 
        {
            $delivery->delete();
            Toastr::success('Delivery deleted successfully!');
        } 
        else 
        {
            Toastr::error('Delivery not found!');
        }

        return back();
    }



    public function search(Request $request)
    {
        $key = explode(' ', $request['search']);
        $deliveries = Delivery::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('id', 'like', "%{$value}%")
                    ->orWhere('order_status', 'like', "%{$value}%");
            }
        })->get();
        return response()->json([
            'view' => view('admin-views.delivery.list', compact('deliveries'))->render()
        ]);
    }
}
