<aside class="app-sidebar" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div style="z-index: -1000" class="main-sidebar-header">
        <div class="header-logo">
            RESTORE
        </div>

    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                     height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                <!-- Start::slide__category -->
                <li style="display: none" class="slide__category"><span class="category-name">Main</span></li>
                <!-- End::slide__category -->

                <!-- Start::slide -->
                <li style="display: none" class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="bx bx-home side-menu__icon"></i>
                        <span class="side-menu__label">Dashboards<span
                                    class="badge !bg-warning/10 !text-warning !py-[0.25rem] !px-[0.45rem] !text-[0.75em] ms-2">12</span></span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide side-menu__label1">
                            <a href="javascript:void(0)">Dashboards</a>
                        </li>

                        <li class="slide active">
                            <a href="index-1.html" class="side-menu__item">Ecommerce</a>
                        </li>
                        <li class="slide">
                            <a href="index-2.html" class="side-menu__item">Crypto</a>
                        </li>

                    </ul>
                </li>
                <!-- End::slide -->


                <!-- Start::slide -->

                @hasanyrole('admin|operator')
                <li class="slide">
                    <a href="/" class="side-menu__item">
                        <span style="margin-right: 10px;text-align: center"
                              class="material-symbols-outlined">home
                        </span>
                        <span class="side-menu__label">შეკვეთები</span>

                        <span id="badge" style="display: none"
                              class="flex absolute h-10 w-10 -top-[1rem] end-1  -me-[1rem]">
              <span class="animate-slow-ping absolute inline-flex -top-[2px] -start-[px] h-full w-full rounded-full bg-secondary/40 opacity-75"></span>
              <span class="relative inline-flex justify-center items-center rounded-full  h-[14.7px] w-[14px] bg-secondary text-[0.625rem] text-white"
                    id="notification-icon-badge2"></span>
            </span>

                    </a>
                </li>
                @endrole

                @role('customer')
                <li class="slide">
                    <a href="{{route('customer-index')}}" class="side-menu__item">
                        <span style="margin-right: 10px;text-align: center"
                              class="material-symbols-outlined">orders</span>
                        <span class="side-menu__label">შეკვეთები</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="{{route('customer-items')}}" class="side-menu__item">
                        <span style="margin-right: 10px;text-align: center"
                              class="material-symbols-outlined">list_alt</span>
                        <span class="side-menu__label">ყველა ამანათი</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="{{route('customer_balance_details')}}" class="side-menu__item">
                        <span style="margin-right: 10px;text-align: center" class="material-symbols-outlined">account_balance_wallet</span>
                        <span class="side-menu__label">ბალანსი</span>
                    </a>
                </li>
                @endrole


                @role('driver')
                <li class="slide">
                    <a href="/" class="side-menu__item">
                        <span style="margin-right: 10px;text-align: center"
                              class="material-symbols-outlined">home</span>
                        <span class="side-menu__label">აქტიური</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="{{route('item-finished')}}" class="side-menu__item">
                        <span style="margin-right: 10px;text-align: center"
                              class="material-symbols-outlined">check_box</span>
                        <span class="side-menu__label">ჩაბარებული</span>
                    </a>
                </li>
                @endrole


                @hasanyrole('admin|operator')

                @role('admin')
                <li class="slide">
                    <a href="{{route('settings')}}" class="side-menu__item">
                        <span style="margin-right: 10px;text-align: center"
                              class="material-symbols-outlined">settings</span>
                        <span class="side-menu__label">მართვა</span>
                    </a>
                </li>
                @endrole
                <li class="slide">
                    <a href="{{route('users')}}" class="side-menu__item">
                        <span style="margin-right: 10px;text-align: center"
                              class="material-symbols-outlined">group</span>
                        <span class="side-menu__label">მომხმარებლები</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="{{route('orders')}}" class="side-menu__item">
                        <span style="margin-right: 10px;text-align: center"
                              class="material-symbols-outlined">list_alt</span>
                        <span class="side-menu__label">ამანათები</span>
                    </a>
                </li>
                @role('admin')
                <li class="slide">
                    <a href="{{route('payments')}}" class="side-menu__item">
                        <span style="margin-right: 10px;text-align: center"
                              class="material-symbols-outlined">payments</span>
                        <span class="side-menu__label">გადახდები</span>
                    </a>
                </li>
                @endrole
                <li class="slide">
                    <a href="{{route('balance')}}" class="side-menu__item">
                        <span style="margin-right: 10px;text-align: center" class="material-symbols-outlined">account_balance_wallet</span>
                        <span class="side-menu__label">ბალანსი</span>
                    </a>
                </li>
                @endhasanyrole


                <!-- End::slide -->

            </ul>
            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                     height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside>