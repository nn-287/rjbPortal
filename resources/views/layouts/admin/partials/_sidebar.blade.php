<div id="sidebarMain" class="d-none">
    <aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container text-capitalize">
            <div class="navbar-vertical-footer-offset">
                <div class="navbar-brand-wrapper justify-content-between">
                    <!-- Logo -->
                    @php($roles=\App\Model\EmployeeRole::where('admin_id', auth('admin')->user()->id)->first())
                    @php($admin=\App\Model\Admin::where('id', auth('admin')->user()->id)->first())
                    @php($store_logo=\App\Model\BusinessSetting::where(['key'=>'logo'])->first()->value)
                    <a class="navbar-brand" aria-label="Front">
                        <img class="navbar-brand-logo" onerror="this.src='{{asset('public/assets/admin/img/160x160/img2.jpg')}}'" src="{{asset('storage/app/public/store/'.$store_logo)}}" alt="Logo">
                        <img class="navbar-brand-logo-mini" onerror="this.src='{{asset('public/assets/admin/img/160x160/img2.jpg')}}'" src="{{asset('storage/app/public/store/'.$store_logo)}}" alt="Logo">
                    </a>
                    <!-- End Logo -->

                    <!-- Navbar Vertical Toggle -->
                    <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->
                </div>

                <!-- Content -->
                <div class="navbar-vertical-content">
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <!-- Dashboards -->
                     
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin')?'show':''}}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" href="{{route('admin.dashboard')}}" title="Dashboards">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.dashboard')}}
                                </span>
                            </a>
                        </li>
                        <!-- End Dashboards -->



                        <!--Start of order section-->

                        <li class="nav-item">
                            <small class="nav-subtitle">{{trans('messages.order')}} {{trans('messages.section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>


                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/orders*')?'active':''}}">

                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <i class="tio-shopping-cart nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{trans('messages.order')}}
                                </span>
                            </a>


                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('admin/order*')?'block':'none'}}">
                                

                                <li class="nav-item {{Request::is('admin/orders/list/all')?'active':''}}">
                                    <a class="nav-link" href="{{route('admin.orders.list',['all'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.all')}}
                                            <span class="badge badge-info badge-pill ml-1">
                                                {{\App\Model\Order::count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                

                                <li class="nav-item {{Request::is('admin/orders/list/pending')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['pending'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.pending')}}
                                            <span class="badge badge-soft-info badge-pill ml-1">
                                               
                                            </span>
                                        </span>
                                    </a>
                                </li>



                                <li class="nav-item {{Request::is('admin/orders/list/accepted')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['accepted'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.Accepted')}}
                                            <span class="badge badge-soft-success badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'accepted'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>



                                <li class="nav-item {{Request::is('admin/orders/list/arrived')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['arrived'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.Arrived')}}
                                            <span class="badge badge-warning badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'arrived'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>



                                <li class="nav-item {{Request::is('admin/orders/list/finished')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['finished'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.Finished')}}
                                            <span class="badge badge-warning badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'finished'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>



                                <li class="nav-item {{Request::is('admin/orders/list/canceled')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.orders.list',['canceled'])}}" title="">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{trans('messages.Canceled')}}
                                            <span class="badge badge-soft-dark badge-pill ml-1">
                                                {{\App\Model\Order::where(['order_status'=>'canceled'])->count()}}
                                            </span>
                                        </span>
                                    </a>
                                </li>


                                
                            </ul>
                        </li>
                        <!--End of orders section-->
                       

                        <!--Delivery Section-->

                        <li class="nav-item">
                            <small class="nav-subtitle">{{trans('messages.delivery')}} {{trans('messages.section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                       
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/delivery*')?'active':''}}">

                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <i class="tio-image nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.delivery')}}</span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('admin/delivery*')?'block':'none'}}">
                               
                                <li class="nav-item {{Request::is('admin/delivery/list')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.delivery.list')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{trans('messages.list')}}</span>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        <!-- End of Delivery section -->




                        <!-- Start of Driver section -->

                         <li class="nav-item">
                            <small class="nav-subtitle">{{trans('messages.driver')}} {{trans('messages.section')}}</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                       
                        <li class="navbar-vertical-aside-has-menu {{Request::is('admin/driver*')?'active':''}}">

                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:">
                                <i class="tio-image nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">{{trans('messages.driver')}}</span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub" style="display: {{Request::is('admin/driver*')?'block':'none'}}">
                               
                                <li class="nav-item {{Request::is('admin/driver/list')?'active':''}}">
                                    <a class="nav-link " href="{{route('admin.driver.list')}}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">{{trans('messages.list')}}</span>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        <!-- End of Driver Section -->





                        <!-- Start of Category -->
                        
                        <!-- End of Category -->


                    <!-- Pages -->
                    
                    <!-- End Pages -->


                    <!-- Pages -->
                    
                    <!-- End Pages -->


                    <li class="nav-item">
                        <small class="nav-subtitle" title="Layouts">{{trans('messages.business')}} {{trans('messages.section')}}</small>
                        <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                    </li>

                    <li class="nav-item {{Request::is('admin/business-settings/store-setup')?'active':''}}">
                        <a class="nav-link " href="">
                            <span class="tio-circle nav-indicator-icon"></span>
                            <span class="text-truncate">Settings</span>
                        </a>
                    </li>

                    <!-- Pages -->
                    
                    <!-- End Pages -->


                    <!-- End Pages -->


                    <!-- Notifications -->
                   
                    <!-- End Pages -->

                    <!-- Pages -->
                    
                    <!-- End Pages -->

                    <!-- Start Zones -->
                   
                    <!-- End Zones -->

                   
                    <!-- End Pages -->



                    <!-- START BRANCH Pages -->
                    
                    <!-- End BRANCH Pages -->


                    <!-- Pages -->
                    
                    <!-- End Pages -->


                </div>
                <!-- End Content -->
            </div>
        </div>
    </aside>
</div>
<div id="sidebarCompact" class="d-none">
</div>