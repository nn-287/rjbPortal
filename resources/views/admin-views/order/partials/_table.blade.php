@foreach($orders as $key=>$order)

    <tr class="status-{{$order['order_status']}} class-all">
        <td class="">
            {{$key+1}}
        </td>
        <td class="table-column-pl-0">
            <a href="{{route('admin.orders.details',['id'=>$order['id']])}}">{{$order['id']}}</a>
        </td>
        <td>{{date('d M Y',strtotime($order['created_at']))}}</td>
        <td>
            @if($order->customer)
                <a class="text-body text-capitalize"
                   href="{{route('admin.customer.view',[$order['user_id']])}}">{{$order->customer['f_name'].' '.$order->customer['l_name']}}</a>
            @else
                <label class="badge badge-danger">{{trans('messages.invalid')}} {{trans('messages.customer')}} {{trans('messages.data')}}</label>
            @endif
        </td>
       
        <td>{{$order['order_amount'] ." ". \App\CentralLogics\Helpers::currency_symbol()}}</td>
        <td class="text-capitalize">
            @if($order['order_status']=='pending')
                <span class="badge badge-soft-info ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-info"></span>{{trans('messages.pending')}}
                                    </span>
            @elseif($order['order_status']=='accepted')
                <span class="badge badge-soft-info ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-info"></span>{{trans('messages.Accepted')}}
                                    </span>
            @elseif($order['order_status']=='canceled')
                <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-warning"></span>{{trans('messages.Canceled')}}
                                    </span>
            @elseif($order['order_status']=='finished')
                <span class="badge badge-soft-warning ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-warning"></span>{{trans('messages.Finished')}}
                                    </span>
            @elseif($order['order_status']=='arrived')
                <span class="badge badge-soft-success ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-success"></span>{{trans('messages.Arrived')}}
                                    </span>
            @else
                <span class="badge badge-soft-danger ml-2 ml-sm-3">
                                      <span class="legend-indicator bg-danger"></span>{{str_replace('_',' ',$order['order_status'])}}
                                    </span>
            @endif
        </td>
        <td>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <i class="tio-settings"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                   
                </div>
            </div>
        </td>
    </tr>

@endforeach
