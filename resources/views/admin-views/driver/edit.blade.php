@extends('layouts.admin.app')

@section('title', 'Update premium-plan')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-edit"></i> {{trans('messages.update')}} {{trans('messages.Plan')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
            <form action="{{ route('admin.driver.update', ['id' => $driver->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $driver->f_name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $driver->l_name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $driver->phone_no }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $driver->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="identity_number">Identity Number</label>
                        <input type="text" class="form-control" id="identity_number" name="identity_number" value="{{ $driver->identity_no }}" required>
                    </div>

                    <div class="form-group">
                        <label for="identity_type">Identity Type</label>
                        <input type="text" class="form-control" id="identity_type" name="identity_type" value="{{ $driver->identity_type }}" required>
                    </div>

                    <div class="form-group">
                        <label for="overall_rating">Overall Rating</label>
                        <input type="number" class="form-control" id="overall_rating" name="overall_rating" min="0" max="5" step="0.1" value="{{ $driver->overall_rating }}" required>
                    </div>

                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $driver->long }}" required>
                    </div>

                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $driver->lat }}" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active" {{ $driver->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $driver->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ trans('messages.driver') }} {{ trans('messages.image') }}</label>
                                <small style="color: red">* ( {{ trans('messages.ratio') }} 3:1 )</small>
                                <div class="custom-file">
                                    <input type="file" name="identity_image" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                    <label class="custom-file-label" for="customFileEg1">{{ trans('messages.choose') }} {{ trans('messages.file') }}</label>
                                </div>
                                <hr>
                                <center>
                                    <img style="width: 80%; border: 1px solid; border-radius: 10px;" id="viewer" src="{{ asset('storage/driver/' . $driver->identity_image) }}" alt="driver image"/>
                                </center>
                            </div>
                         </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Driver</button>
                </form>

            </div>
        </div>
    </div>
@endsection
@push('script_2')
@endpush