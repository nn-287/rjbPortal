@extends('layouts.admin.app')

@section('title','Order Details')

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-no-gutter">
                            <li class="breadcrumb-item">
                                <a class="breadcrumb-link"
                                   href="{{route('admin.orders.list',['status'=>'all'])}}">
                                    Orders
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{trans('messages.order')}} {{trans('messages.details')}}</li>
                        </ol>
                    </nav>

                    <div class="d-sm-flex align-items-sm-center">
                        <h1 class="page-header-title">{{trans('messages.order')}} #{{$order['id']}}</h1>

                        @if($order['payment_status']=='paid')
                            <span class="badge badge-soft-success ml-sm-3">
                                <span class="legend-indicator bg-success"></span>{{trans('messages.paid')}}
                            </span>
                        @else
                            <span class="badge badge-soft-danger ml-sm-3">
                                <span class="legend-indicator bg-danger"></span>{{trans('messages.unpaid')}}
                            </span>
                        @endif


                        @if($order['order_status']=='pending')
                            <span class="badge badge-soft-info ml-2 ml-sm-3 text-capitalize">
                              <span class="legend-indicator bg-info text"></span>{{trans('messages.pending')}}
                            </span>
                        @elseif($order['order_status']=='accepted')
                            <span class="badge badge-soft-info ml-2 ml-sm-3 text-capitalize">
                              <span class="legend-indicator bg-info"></span>{{trans('messages.Accepted')}}
                            </span>
                        @elseif($order['order_status']=='finished')
                            <span class="badge badge-soft-warning ml-2 ml-sm-3 text-capitalize">
                              <span class="legend-indicator bg-warning"></span>{{trans('messages.Finished')}}
                            </span>
                        @elseif($order['order_status']=='canceled')
                            <span class="badge badge-soft-warning ml-2 ml-sm-3 text-capitalize">
                              <span class="legend-indicator bg-warning"></span>{{trans('messages.Canceled')}}
                            </span>
                        @elseif($order['order_status']=='arrived')
                            <span class="badge badge-soft-success ml-2 ml-sm-3 text-capitalize">
                              <span class="legend-indicator bg-success"></span>{{trans('messages.Arrived')}}
                            </span>
                        @else
                            <span class="badge badge-soft-danger ml-2 ml-sm-3 text-capitalize">
                              <span class="legend-indicator bg-danger"></span>{{str_replace('_',' ',$order['order_status'])}}
                            </span>
                        @endif
                        <span class="ml-2 ml-sm-3">
                            <i class="tio-date-range"></i> {{date('d M Y H:i:s',strtotime($order['created_at']))}}
                         </span>
                    </div>

                    <div class="mt-2">
                        <div class="hs-unfold float-right">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    {{trans('messages.status')}}
                                </button>

                                <div class="dropdown-menu text-capitalize" aria-labelledby="dropdownMenuButton">

                                    <a class="dropdown-item"
                                       onclick="route_alert('{{route('admin.orders.status',['id'=>$order['id'],'order_status'=>'pending'])}}','Change status to pending ?')"
                                       href="javascript:">{{trans('messages.pending')}}
                                    </a>

                                    <a class="dropdown-item"
                                       onclick="route_alert('{{route('admin.orders.status',['id'=>$order['id'],'order_status'=>'accepted'])}}','Change status to accepeted ?')"
                                       href="javascript:">{{trans('messages.Accepted')}}
                                    </a>

                                    <a class="dropdown-item"
                                       onclick="route_alert('{{route('admin.orders.status',['id'=>$order['id'],'order_status'=>'arrived'])}}','Change status to arrived ?')"
                                       href="javascript:">{{trans('messages.Arrived')}}
                                    </a>

                                    <a class="dropdown-item"
                                       onclick="route_alert('{{route('admin.orders.status',['id'=>$order['id'],'order_status'=>'canceled'])}}','Change status to canceled ?')"
                                       href="javascript:">{{trans('messages.Canceled')}}
                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="hs-unfold float-right pr-2">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    {{trans('messages.payment')}}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item"
                                       onclick="route_alert('{{route('admin.orders.payment-status',['id'=>$order['id'],'payment_status'=>'paid'])}}','Change status to paid ?')"
                                       href="javascript:">{{trans('messages.paid')}}</a>
                                    <a class="dropdown-item"
                                       onclick="route_alert('{{route('admin.orders.payment-status',['id'=>$order['id'],'payment_status'=>'unpaid'])}}','Change status to unpaid ?')"
                                       href="javascript:">{{trans('messages.unpaid')}}</a>
                                </div>
                            </div>
                        </div>
                        <!-- End Unfold -->
                    </div>
                </div>
                
                <div class="col-sm-auto">
                    <a class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle mr-1"
                       href="{{route('admin.orders.details',[$order['id']-1])}}"
                       data-toggle="tooltip" data-placement="top" title="Previous order">
                        <i class="tio-arrow-backward"></i>
                    </a>
                    <a class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle"
                       href="{{route('admin.orders.details',[$order['id']+1])}}" data-toggle="tooltip"
                       data-placement="top" title="Next order">
                        <i class="tio-arrow-forward"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="row" id="printableArea">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <!-- Card -->
                <div class="card mb-3 mb-lg-5">
                    <!-- Header -->
                    <div class="card-header" style="display: block!important;">
                        <div class="row">
                            <hr>
                                <div class="col-12 pb-2 border-bottom">
                                    <div style="padding-top: 10px;" class="column">
                                </div>  
                            <hr>

                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Body -->
                    <div class="card-body">
                        <div class="card-body">
                            <h5 class="card-title">Order #{{ $order->id }}</h5>
                            <table class="table">
                                <tbody>

                                    <tr>
                                        <th>Sender ID:</th>
                                        <td>{{ $order->driver_id }}</td>
                                    </tr>

                                    <tr>
                                        <th>Sender:</th>
                                        <td>{{ $order->user->f_name }} {{ $order->user->l_name }}</td>
                                    </tr>

                                    <tr>
                                        <th>Phone:</th>
                                        <td>{{ $order->user->phone_no }}</td>
                                    </tr>

                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $order->user->email }}</td>
                                    </tr>


                                    <tr>
                                        <th>Driver ID:</th>
                                        <td>{{ $order->driver_id }}</td>
                                    </tr>
                                <tr>
                                    <th>Driver:</th>
                                    <td>{{ $order->driver->f_name }} {{ $order->driver->l_name }}</td>
                                </tr>

                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $order->driver->phone_no }}</td>
                                </tr>

                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $order->driver->email }}</td>
                                </tr>
                                

                                <tr>
                                    <th>Identity Number:</th>
                                    <td>{{ $order->driver->identity_no }}</td>
                                </tr>

                                <tr>
                                    <th>Identity Image:</th>
                                    <td>{{ $order->driver->identity_image }}</td>
                                </tr>


                                <tr>
                                    <th>Identity type:</th>
                                    <td>{{ $order->driver->identity_type }}</td>
                                </tr>


                                <tr>
                                    <th>Overall rating:</th>
                                    <td>{{ $order->driver->overall_rating }}</td>
                                </tr>

                                <tr>
                                    <th>Pickup insights:</th>
                                    <td>{{ $order->driver_Lat }}, {{ $order->driver_Long }}</td>
                                </tr>

                            </tbody>
                            </table>
                        </div>

                        <div class="row justify-content-md-end mb-3">
                            <div class="col-md-9 col-lg-8">
                               
                                <!-- End Row -->
                            </div>
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-4">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                   
                    <!-- End Header -->

                    <!-- Body -->
                    
                <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->
    </div>

    <!-- Modal -->
   
    <!-- End Modal -->

    <!-- Modal -->
    <div id="shipping-address-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalTopCoverTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-top-cover bg-dark text-center">
                    <figure class="position-absolute right-0 bottom-0 left-0" style="margin-bottom: -1px;">
                        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                             viewBox="0 0 1920 100.1">
                            <path fill="#fff" d="M0,0c0,0,934.4,93.4,1920,0v100.1H0L0,0z"/>
                        </svg>
                    </figure>

                    <div class="modal-close">
                        <button type="button" class="btn btn-icon btn-sm btn-ghost-light" data-dismiss="modal"
                                aria-label="Close">
                            <svg width="16" height="16" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor"
                                      d="M11.5,9.5l5-5c0.2-0.2,0.2-0.6-0.1-0.9l-1-1c-0.3-0.3-0.7-0.3-0.9-0.1l-5,5l-5-5C4.3,2.3,3.9,2.4,3.6,2.6l-1,1 C2.4,3.9,2.3,4.3,2.5,4.5l5,5l-5,5c-0.2,0.2-0.2,0.6,0.1,0.9l1,1c0.3,0.3,0.7,0.3,0.9,0.1l5-5l5,5c0.2,0.2,0.6,0.2,0.9-0.1l1-1 c0.3-0.3,0.3-0.7,0.1-0.9L11.5,9.5z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- End Header -->

                <div class="modal-top-cover-icon">
                    <span class="icon icon-lg icon-light icon-circle icon-centered shadow-soft">
                      <i class="tio-location-search"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
@endsection