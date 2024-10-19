<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Model\Driver;

class DriverController extends Controller
{
    public function ListDriver()
    {
        $drivers = Driver::paginate(10);
        return view('admin-views.driver.list', compact('drivers'));
    }


    function Addnew()
    {
        return view('admin-views.driver.add-new');
    }


    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'identity_type' => 'required|string',
            'identity_number' => 'required|string',
            'overall_rating' => 'required|numeric',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'status' => 'required|string',
            'identity_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        if ($request->hasFile('identity_image')) {
            $image_name = Carbon::now()->toDateString() . "-" . uniqid() . "." . $request->file('identity_image')->getClientOriginalExtension();
            $request->file('identity_image')->storeAs('public/driver', $image_name);
        } else {
            $image_name = 'def.png';
        }
    
        $driver = new Driver;
        $driver->f_name = $request->first_name;
        $driver->l_name = $request->last_name;
        $driver->phone_no = $request->phone_number;
        $driver->email = $request->email;
        $driver->identity_type = $request->identity_type;
        $driver->identity_no = $request->identity_number;
        $driver->overall_rating = $request->overall_rating;
        $driver->long = $request->longitude;
        $driver->lat = $request->latitude;
        $driver->status = $request->status;
        $driver->identity_image = $image_name;
        $driver->save();
    
        Toastr::success('Driver added successfully!');
        return redirect('admin/driver/list');
    }



    public function edit($id)
    {
        $driver = Driver::findOrFail($id);
        return view('admin-views.driver.edit', compact('driver'));
        
    }

    

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'identity_type' => 'required|string',
            'identity_number' => 'required|string',
            'overall_rating' => 'required|numeric',
            'longitude' => 'required|string',
            'latitude' => 'required|string',
            'status' => 'required|string',
            'identity_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $driver = Driver::findOrFail($id);

    
        if ($request->hasFile('identity_image')) {
            $image_name = Carbon::now()->toDateString() . "-" . uniqid() . "." . 'png';
            if (!Storage::disk('public')->exists('driver')) {
                Storage::disk('public')->makeDirectory('driver');
            }
            if ($driver->identity_image && Storage::disk('public')->exists('driver/' . $driver->identity_image)) {
                Storage::disk('public')->delete('driver/' . $driver->identity_image);
            }
            $note_img = Image::make($request->file('identity_image'))->stream();
            Storage::disk('public')->put('driver/' . $image_name, $note_img);
            $driver->identity_image = $image_name;
        }

        $driver->f_name = $request->first_name;
        $driver->l_name = $request->last_name;
        $driver->phone_no = $request->phone_number;
        $driver->email = $request->email;
        $driver->identity_type = $request->identity_type;
        $driver->identity_no = $request->identity_number;
        $driver->overall_rating = $request->overall_rating;
        $driver->long = $request->longitude;
        $driver->lat = $request->latitude;
        $driver->status = $request->status;
        $driver->save();

        Toastr::success('Driver updated successfully!');
        return redirect('admin/driver/list');
    }





    public function RemoveDriver(Request $request)
    {
        $driver = Driver::find($request->id);
        if (Storage::disk('public')->exists('driver/' . $driver->identity_image)) {
            Storage::disk('public')->delete('driver/' . $driver->identity_image);
        }
        $driver->delete();
        Toastr::success('Driver removed successfully!');
        return back();
    }




    public function search(Request $request)
    {
        $key = explode(' ', $request['search']);
        $drivers = Driver::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('id', 'like', "%{$value}%")
                    ->orWhere('order_status', 'like', "%{$value}%");
            }
        })->get();
        return response()->json([
            'view' => view('admin-views.driver.list', compact('drivers'))->render()
        ]);
    }
    
}
