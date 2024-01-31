<aside class="app-sidebar" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
RESTORE
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
                <li class="slide">
                    <a href="/" class="side-menu__item">
                   <span style="margin-right: 10px;text-align: center" class="material-symbols-outlined">home</span>
                        <span class="side-menu__label">მთავარი</span>
                    </a>
                </li>
                @role('customer')
                <li class="slide">
                    <a href="widgets.html" class="side-menu__item">
                        <i class="bx bx-gift side-menu__icon"></i>
                        <span class="side-menu__label">ყველა ამანათი</span>
                    </a>
                </li>
                @endrole
                @hasanyrole('admin|operator')
                <li class="slide">
                    <a href="{{route('settings')}}" class="side-menu__item">
                        <span style="margin-right: 10px;text-align: center" class="material-symbols-outlined">settings</span>
                        <span class="side-menu__label">მართვა</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="{{route('users')}}" class="side-menu__item">
                      <span style="margin-right: 10px;text-align: center" class="material-symbols-outlined">group</span>
                        <span class="side-menu__label">მომხმარებლები</span>
                    </a>
                </li>
                <li class="slide">
                    <a href="{{route('orders')}}" class="side-menu__item">
                        <span style="margin-right: 10px;text-align: center" class="material-symbols-outlined">list_alt</span>
                        <span class="side-menu__label">შეკვეთები</span>
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