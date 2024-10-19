@extends('layouts.admin.app')

@section('title','Driver List')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header ">
        <div class="row align-items-center mb-3">
            <div class="col-sm">
                <h1 class="page-header-title">{{trans('messages.Driver')}}</h1>
                <a href="{{ route('admin.driver.add-new') }}">{{trans('messages.assign')}} {{trans('messages.new')}} {{trans('messages.Driver')}}</a>
            </div>
        </div>
        <!-- End Row -->

        <!-- Nav Scroller -->
        <div class="js-nav-scroller hs-nav-scroller-horizontal bg-dark-grey">
            <span class="hs-nav-scroller-arrow-prev" style="display: none;">
                <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="tio-chevron-left"></i>
                </a>
            </span>

            <span class="hs-nav-scroller-arrow-next" style="display: none;">
                <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                    <i class="tio-chevron-right"></i>
                </a>
            </span>

            <!-- Nav -->
            <ul class="nav nav-tabs page-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">{{trans('messages.Driver')}} {{trans('messages.list')}}</a>
                </li>
            </ul>
            <!-- End Nav -->
        </div>
        <!-- End Nav Scroller -->
    </div>
    <!-- End Page Header -->

    <!-- Card -->
    <div class="card bg-dark-grey border-0 ">
        <!-- Header -->
        <div class="card-header bg-dark-grey">
            <div class="row justify-content-between align-items-center flex-grow-1">
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <form action="javascript:" id="search-form">
                        <!-- Search -->
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tio-search text-light"></i>
                                </div>
                            </div>
                            <input id="datatableSearch_" type="search" name="search" class="form-control border-secondary text-light" placeholder="Search" aria-label="Search" required>
                            <button type="submit" class="btn btn-primary">search</button>

                        </div>
                        <!-- End Search -->
                    </form>
                </div>

                <div class="col-lg-6">
                    <div class="d-sm-flex justify-content-sm-end align-items-sm-center">
                        <!-- Datatable Info -->
                        <div id="datatableCounterInfo" class="mr-2 mb-2 mb-sm-0" style="display: none;">
                            <div class="d-flex align-items-center">
                                <span class="font-size-sm mr-3">
                                    <span id="datatableCounter">0</span>
                                    {{trans('messages.selected')}}
                                </span>
                            </div>
                        </div>
                        <!-- End Datatable Info -->

                        <!-- Unfold (Export actions)-->
                        <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker bg-dark-grey text-white-50 btn btn-sm btn-white dropdown-toggle" href="javascript:;" data-hs-unfold-options='{
                                     "target": "#usersExportDropdown",
                                     "type": "css-animation"
                                   }'>
                                <i class="tio-download-to mr-1"></i> {{trans('messages.export')}}
                            </a>

                            <div id="usersExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                                <span class="dropdown-header">{{trans('messages.options')}}</span>
                                <a id="export-copy" class="dropdown-item" href="javascript:;">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('public/assets/admin')}}/svg/illustrations/copy.svg" alt="Image Description">
                                    {{trans('messages.copy')}}
                                </a>
                                <a id="export-print" class="dropdown-item" href="javascript:;">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('public/assets/admin')}}/svg/illustrations/print.svg" alt="Image Description">
                                    {{trans('messages.print')}}
                                </a>
                                <div class="dropdown-divider"></div>
                                <span class="dropdown-header">{{trans('messages.download')}} {{trans('messages.options')}}</span>
                                <a id="export-excel" class="dropdown-item" href="javascript:;">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('public/assets/admin')}}/svg/components/excel.svg" alt="Image Description">
                                    {{trans('messages.excel')}}
                                </a>
                                <a id="export-csv" class="dropdown-item" href="javascript:;">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('public/assets/admin')}}/svg/components/placeholder-csv-format.svg" alt="Image Description">
                                    .{{trans('messages.csv')}}
                                </a>
                                <a id="export-pdf" class="dropdown-item" href="javascript:;">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('public/assets/admin')}}/svg/components/pdf.svg" alt="Image Description">
                                    {{trans('messages.pdf')}}
                                </a>
                            </div>
                        </div>
                        <!-- End Unfold (Export actions) -->



                        <!-- Unfold -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker bg-dark-grey text-white-50 btn btn-sm btn-white" href="javascript:;" data-hs-unfold-options='{
                                     "target": "#showHideDropdown",
                                     "type": "css-animation"
                                   }'>
                                <i class="tio-table mr-1"></i> {{trans('messages.columns')}} <span class="badge badge-info rounded-circle ml-1">7</span>
                            </a>

                            <div id="showHideDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card" style="width: 15rem;">
                                <div class="card card-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2">{{trans('messages.order')}}</span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm" for="toggleColumn_order">
                                                <input type="checkbox" class="toggle-switch-input" id="toggleColumn_order" checked>
                                                <span class="toggle-switch-label">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>


                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2">{{trans('messages.Driver_id')}}</span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm" for="toggleColumn_date">
                                                <input type="checkbox" class="toggle-switch-input" id="toggleColumn_date" checked>
                                                <span class="toggle-switch-label">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>


                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2"></span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm" for="toggleColumn_customer">
                                                <input type="checkbox" class="toggle-switch-input" id="toggleColumn_customer" checked>
                                                <span class="toggle-switch-label">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="mr-2"></span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm" for="toggleColumn_payment_status">
                                                <input type="checkbox" class="toggle-switch-input" id="toggleColumn_payment_status" checked>
                                                <span class="toggle-switch-label">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>


                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="mr-2">{{trans('messages.actions')}}</span>

                                            <!-- Checkbox Switch -->
                                            <label class="toggle-switch toggle-switch-sm" for="toggleColumn_actions">
                                                <input type="checkbox" class="toggle-switch-input" id="toggleColumn_actions" checked>
                                                <span class="toggle-switch-label">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                            </label>
                                            <!-- End Checkbox Switch -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Unfold -->
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
        <!-- End Header -->

        <!-- Table -->
            <div class="table-responsive  datatable-custom">
                <table id="datatable" class="table  table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table" style="width: 100%" data-hs-datatables-options='{
                     "columnDefs": [{
                        "targets": [0],
                        "orderable": false
                      }],
                     "order": [],
                     "info": {
                       "totalQty": "#datatableWithPaginationInfoTotalQty"
                     },
                     "search": "#datatableSearch",
                     "entries": "#datatableEntries",
                     "pageLength": 25,
                     "isResponsive": false,
                     "isShowPaging": false,
                     "pagination": "datatablePagination"
                   }'>
                   <thead>
                    <tr>
                        <th>Driver ID</th>
                        <th>Driver Name</th>
                        <th>Driver Phone Number</th>
                        <th>Driver Email</th>
                        <th>Identity Image</th>
                        <th>Identity Number</th>
                        <th>Identity Type</th>
                        <th>Overall Rating</th>
                        <th>Longitude</th>
                        <th>Latitude</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($drivers as $driver)
                        <tr>
                            <td>{{ $driver->id }}</td>
                            <td>{{ $driver->f_name }} {{ $driver->l_name }}</td>
                            <td>{{ $driver->phone_no }}</td>
                            <td>{{ $driver->email }}</td>
                            <td>
                                @if ($driver->identity_image)
                                <img src="{{ asset('storage/' . $driver->identity_image) }}" alt="Image" width="50">
                                @endif
                            </td>
                            <td>{{ $driver->identity_no }}</td>
                            <td>{{ $driver->identity_type }}</td>
                            <td>{{ $driver->overall_rating }}</td>
                            <td>{{ $driver->long }}</td>
                            <td>{{ $driver->lat }}</td>
                            <td>{{ $driver->status }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="tio-settings text-white-50"></i>
                                    </button>
                                    <div class="dropdown-menu bg-dark-grey" aria-labelledby="dropdownMenuButton">

                                        <a class="dropdown-item" href="{{route('admin.driver.edit',[$driver['id']])}}">
                                            <i class="tio-visible"></i> {{trans('messages.edit')}}
                                        </a>

                                        <a class="dropdown-item text-white" href="#" onclick="confirmDelete(event, {{ $driver->id }});">
                                            <i class="tio-delete text-white-50"></i> {{ trans('messages.delete') }}
                                        </a>
                                    </div>
                                </div>
                                <form action="{{ route('admin.driver.delete', ['id' => $driver['id']]) }}" method="post" id="driver-{{ $driver->id }}">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        <!-- End Table -->

        <!-- Footer -->
        <div class="card-footer bg-dark-grey">
            <!-- Pagination -->
            <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                <div class="col-sm-auto">
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        <!-- Pagination -->
                    </div>
                </div>
            </div>
            <!-- End Pagination -->
        </div>
        <!-- End Footer -->
    </div>
    <!-- End Card -->
</div>
@endsection
@push('script_2')
    <script>

        function confirmDelete(event, driverId) {
            event.preventDefault();
            if (confirm('Are you sure you want to delete this driver?')) {
                document.getElementById('driver-' + driverId).submit();
            }
        }

        $(document).on('ready', function () {
            // INITIALIZATION OF NAV SCROLLER
            // =======================================================
            $('.js-nav-scroller').each(function () {
                new HsNavScroller($(this)).init()
            });

            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });


            // INITIALIZATION OF DATATABLES
            // =======================================================
            var datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        className: 'd-none'
                    },
                    {
                        extend: 'excel',
                        className: 'd-none'
                    },
                    {
                        extend: 'csv',
                        className: 'd-none'
                    },
                    {
                        extend: 'pdf',
                        className: 'd-none'
                    },
                    {
                        extend: 'print',
                        className: 'd-none'
                    },
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child input[type="checkbox"]',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                language: {
                    zeroRecords: '<div class="text-center p-4">' +
                        '<img class="mb-3 rounded-pill shadow " src="{{asset('public/assets/admin')}}/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;background:grey;">' +
                        '<p class="mb-0 text-white">No data to show</p>' +
                        '</div>'
                }
            });


             function updateColumnVisibility(columnIndex, isVisible) {
                datatable.column(columnIndex).visible(isVisible);
            }

            $('#export-copy').click(function () {
                datatable.button('.buttons-copy').trigger()
            });

            $('#export-excel').click(function () {
                datatable.button('.buttons-excel').trigger()
            });

            $('#export-csv').click(function () {
                datatable.button('.buttons-csv').trigger()
            });

            $('#export-pdf').click(function () {
                datatable.button('.buttons-pdf').trigger()
            });

            $('#export-print').click(function () {
                datatable.button('.buttons-print').trigger()
            });

            $('#datatableSearch').on('mouseup', function (e) {
                var $input = $(this),
                    oldValue = $input.val();

                if (oldValue == "") return;

                setTimeout(function () {
                    var newValue = $input.val();

                    if (newValue == "") {
                        // Gotcha
                        datatable.search('').draw();
                    }
                }, 1);
            });

            $('#toggleColumn_order').change(function (e) {
                datatable.columns(1).visible(e.target.checked)
            })

            $('#toggleColumn_Order_id').change(function (e) {
                datatable.columns(2).visible(e.target.checked)
            })

            $('#toggleColumn_Traveler_id').change(function (e) {
                datatable.columns(3).visible(e.target.checked)
            })

            $('#toggleColumn_Issue_date').change(function (e) {
                datatable.columns(4).visible(e.target.checked)
            })

            $('#toggleColumn_Order_status').change(function (e) {
                datatable.columns(5).visible(e.target.checked)
            })

            $('#toggleColumn_actions').change(function (e) {
                datatable.columns(8).visible(e.target.checked)
            })

            // INITIALIZATION OF TAGIFY
            // =======================================================
            $('.js-tagify').each(function () {
                var tagify = $.HSCore.components.HSTagify.init($(this));
            });
        });
    </script>

<script>
        $('#search-form').on('submit', function () {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.driver.search')}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#set-rows').html(data.view);
                    $('.card-footer').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
@endpush