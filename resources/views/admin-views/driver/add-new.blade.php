@extends('layouts.admin.app')

@section('title', 'Add New Driver')

@push('css_or_js')
    
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> Add New Driver</h1>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.driver.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                   
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>

               
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                    </div>

                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                   
                  
                    <div class="form-group">
                        <label for="identity_number">Identity Number</label>
                        <input type="text" class="form-control" id="identity_number" name="identity_number" required>
                    </div>

                   
                    <div class="form-group">
                        <label for="identity_type">Identity Type</label>
                        <input type="text" class="form-control" id="identity_type" name="identity_type" placeholder="Enter Identity Type" required>
                    </div>


                    
                    <div class="form-group">
                        <label for="overall_rating">Overall Rating</label>
                        <input type="number" class="form-control" id="overall_rating" name="overall_rating" min="0" max="5" step="0.1" required>
                    </div>

                   
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" required>
                    </div>

                    
                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" required>
                    </div>

                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>


                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{trans('messages.Identity')}} {{trans('messages.image')}}</label><small style="color: red">* ( {{trans('messages.ratio')}} 3:1 )</small>
                                <div class="custom-file">
                                    <input type="file" name="identity_image" id="customFileEg1" class="custom-file-input" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                                    <label class="custom-file-label" for="customFileEg1">{{trans('messages.choose')}} {{trans('messages.file')}}</label>
                                </div>
                                <hr>
                                <center>
                                    <img style="width: 80%;border: 1px solid; border-radius: 10px;" id="viewer" src="{{ asset('public/assets/admin/img/900x400/img1.jpg') }}" alt="driver image"/>
                                </center>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Add driver</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            // Function to read selected file and display preview
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#viewer').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            // Call readURL function when file input changes
            $("#customFileEg1").change(function () {
                readURL(this);
            });
        });
    </script>
@endpush