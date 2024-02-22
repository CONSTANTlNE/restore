<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" class="dark" data-header-styles="dark" data-menu-styles="dark">
@php
    //        dd($jsonSectors)
@endphp
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords"
          content="ციფრული მენიუ, QR მენიუ, რესტორნის მენიუ, შეფასების სისტემა, QR menu, ელექტრონული მენიუ">
    @role('admin')
    <title> RESTORE-ADMIN </title>
    @endrole
    @role('customer')
    <title> RESTORE-Customer </title>
    @endrole
    @role('operator')
    <title> RESTORE-Operator </title>
    @endrole
    @role('driver')
    <title> RESTORE-Courier </title>
    @endrole
    @guest
        <title> RESTORE-Guest </title>
    @endguest
    <meta name="theme-color" content="#EEF2FF">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/brand-logos/favicon.ico')}}">
    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>
    <!-- Style Css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- Simplebar Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/simplebar/simplebar.min.css')}}">
    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{asset('assets/libs/@simonwep/pickr/themes/nano.min.css')}}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"/>
    <link rel="stylesheet" href="{{asset('assets/my_styles.css')}}">
    <!-- Tom Select -->
    <link rel="stylesheet" href="{{asset('assets/libs/tom-select/css/tom-select.default.min.css')}}">

    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">

    <style>
        /* For Chrome, Safari, and Opera browsers */
        .dataTables_scrollBody::-webkit-scrollbar {
            height: 1em !important; /* Change the height here for horizontal scroll */
        }

    </style>
</head>

<body>


<!-- ========== Switcher  ========== -->
@include('components.switcher')

<!-- ========== END Switcher  ========== -->

<!-- Loader -->
<div id="loader">
    <img src="{{asset('assets/images/media/loader.svg')}}" alt="">
</div>
<!-- Loader -->
<div class="page">

    <!-- Start::Header -->
    @if(!request()->routeIs('customer_order_edit'))
        @include('components.header')
        <!-- End::Header -->

        <!-- Start::app-sidebar -->
        @include('components.sidebar')
    @endif
    <!-- End::app-sidebar -->


    <!-- Start::content  -->
    <div class="content">
        <!-- Start::main-content -->
        <div class="main-content">
            @yield('customer-orders')
            @yield('customer-packages')
            @yield('admin-users')
            @yield('admin-orders')
            @yield('admin-settings')
            @yield('admin-balance')
            @yield('admin-payments')
            @yield('admin-balance-detailed')
            @yield('driver-index')
            @yield('driver-finished')
            @yield('customer-order-edit')
        </div>
    </div>
    <!-- End::content  -->

    <!-- ========== Search Modal ========== -->
    @include('components.searchModal')
    <!-- ========== END Search Modal ========== -->

    @if(!request()->routeIs('customer_order_edit'))
        <!-- Footer Start -->
        @include('components.footer')
        <!-- Footer End -->
    @endif
</div>

<!-- Back To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="ri-arrow-up-s-fill text-xl"></i></span>
</div>

<div id="responsive-overlay"></div>

{{--<audio id="notification-sound" src="{{asset('assets/sms.mp3')}} " preload="auto"></audio>--}}
{{--<button style="display: none" id="play-button">Play Sound</button>--}}

<!-- Preline JS -->
<script src="{{asset('assets/libs/preline/preline.js')}}"></script>
<!-- popperjs -->
<script src="{{asset('assets/libs/@popperjs/core/umd/popper.min.js')}}"></script>
<!-- Color Picker JS -->
<script src="{{asset('assets/libs/@simonwep/pickr/pickr.es5.min.js')}}"></script>
<!-- sidebar JS -->
<script src="{{asset('assets/js/defaultmenu.js')}}"></script>
<!-- sticky JS -->
<script src="{{asset('assets/js/sticky.js')}}"></script>
<!-- Switch JS -->
<script src="{{asset('assets/js/switch.js')}}"></script>
<!-- Simplebar JS -->
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<!-- Custom-Switcher JS -->
<script src="{{asset('assets/js/custom-switcher.js')}}"></script>
<!-- Modal JS -->
<script src="{{asset('assets/js/modal.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('assets/js/custom.js')}}"></script>


@if(request()->routeIs('customer-index'))
    {{-- ORDER MODAL--}}
    <script>
        const orderCount = document.querySelector('.orderCount')
        let typingTimer;
        const time = 3000; // 3 seconds
        orderCount.addEventListener('keyup', () => {
            typingTimer = setTimeout(() => {
                orderCount.disabled = true;
            }, time);
        });


        const btnContainer = document.querySelector('.btnContainer')
        const orderInfoContainer = document.querySelector('.orderInfoContainer')
        const sectors = {!! $jsonSectors !!};
        console.log(sectors)

        //=================ახალი ამანათის Bulk დამატება==================
        orderCount.addEventListener('input', () => {

            for (let i = 1; i <= orderCount.value; i++) {

                const rand = Math.floor(Math.random() * 900) + 100;

                const buttonHTML = `
         <button
          type="button"
          class="removeButton removes hs-tab-active:bg-white hs-tab-active:border-e-transparent hs-tab-active:text-primary dark:hs-tab-active:bg-transparent dark:hs-tab-active:border-e-gray-800 dark:hs-tab-active:text-primary -me-px py-2 px-3 inline-flex items-center gap-2 bg-gray-50 text-sm font-medium text-center border text-defaulttextcolor rounded-s-sm hover:text-primary dark:bg-black/20 dark:border-white/10 dark:text-[#8c9097] dark:text-white/50 dark:hover:text-gray-300
          "
          id="hs-tab-js-vertical-item-${rand}"
          data-hs-tab="#hs-tab-js-vertical-${rand}"
          aria-controls="hs-tab-js-vertical-${rand}"
        >
            <span class="material-symbols-outlined">
            package_2
            </span>
          </button>
           `;
                btnContainer.innerHTML += buttonHTML

                const orderInfoHTML =
                    `<div id="hs-tab-js-vertical-${rand}"
                class="hidden   removeInfo"
                role="tabpanel"
                aria-labelledby="hs-tab-js-vertical-item-${rand}">
                <div class="px-3">
                 <div class="flex justify-center mb-3">
                  <button style="margin-right:2rem" type="button" class="ti-btn ti-btn-light ti-btn-wave mr-2">ამანათი No: ${i}</button>
                   <button type="button"  class="ti-btn ti-btn-danger ti-btn-wave deleteButton">წაშლა</button>
                 </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 text-center">
                        <label for="package-id${i}" class="form-label">იდენტიფიკატორი</label>
                        <input  type="text" name="package-id[]" class="form-control validation" id="package-id${i}" placeholder="ამანათის განმასხვავებელი (No ან სხვა)">
                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                        <label for="package-descr${i}" class="form-label">აღწერა</label>
                        <input  type="text" name="package-descr[]" class="form-control validation" id="package-descr${i}" placeholder="ამანათის შიგთვსის მოკლე აღწერა">
                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                        <label for="weight${i}" class="form-label">წონა</label>
                        <input   type="text" name="weight[]" class="form-control validation" id="weight${i}" placeholder="ამანათის წონა">
                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2 flex flex-col">
                        <label for="package_value${i}" class="form-label m-auto">ამანათის ღირებულება</label>
                        <input style="width:100px;padding: 8px"  type="text" name="package_value[]" class="form-control validation m-auto" id="package_value${i}" placeholder="ღირებულება">
                    </div>
                      <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                        <label  class="form-label mt-2">მოცულობა</label>
                      <div class="sm:flex rounded-sm">
                        <input  type="text" name="length[]" class="validation ti-form-input rounded-none -mt-px -ms-px first:rounded-t-sm last:rounded-b-sm sm:first:rounded-s-sm sm:mt-0 sm:first:ms-0  sm:first:rounded-se-none  sm:last:rounded-es-none  sm:last:rounded-e-sm  relative focus:z-10" id="length${i}" placeholder="სიგრძე სმ">
                        <input  type="text" name="width[]" class="validation ti-form-input rounded-none -mt-px -ms-px first:rounded-t-sm last:rounded-b-sm sm:first:rounded-s-sm sm:mt-0 sm:first:ms-0  sm:first:rounded-se-none  sm:last:rounded-es-none  sm:last:rounded-e-sm  relative focus:z-10" id="width${i}" placeholder="სიგანე სმ">
                        <input  type="text" name="height[]" class="validation ti-form-input rounded-none -mt-px -ms-px first:rounded-t-sm last:rounded-b-sm sm:first:rounded-s-sm sm:mt-0 sm:first:ms-0  sm:first:rounded-se-none  sm:last:rounded-es-none  sm:last:rounded-e-sm  relative focus:z-10" id="height${i}" placeholder="სიმაღლე სმ">
                    </div>
                   </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                        <label for="recipient${i}" class="form-label">მიმღები</label>
                        <input  type="text" name="recipient[]" class="form-control validation" id="recipient${i}" placeholder="მიმღების სახელი-გვარი">
                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                        <label for="recipient-mobile${i}" class="form-label">მიმღების საკონტაქტო</label>
                        <input  type="tel" name="recipient-mobile[]"  class="form-control validation" id="recipient-mobile${i}" placeholder="მიმღების მობილურის ნომერი">
                    </div>
                        <div class="box mt-3">
                          <div class="box-header">
                            <h5 class="box-title text-center">სექტორი და მისამართი</h5>
                          </div>
                          <div class="box">
                          <div class="flex gap-8 justify-center mt-4">
                                <select style='width:150px' name="sector[]" class="ti-form-select rounded-sm !p-0 deliveryprice tomselect2"   autocomplete="off">
                                  <option value=""></option>
                                </select>


                            </div>
                             <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                                <label for="recipient-address${i}" class="form-label">მისამართი</label>
                                <input  type="text" name="recipient-address[]" class="form-control validation" id="recipient-address${i}" placeholder="ჩაბარების მისამართი დეტალურად">
                            </div>
                          </div>
                        </div>

                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                        <label for="comment${i}" class="form-label">დამატებითი შენიშვნა</label>
                        <input  type="text" name="comment[]" class="form-control" id="comment${i}" placeholder="თქვენთვის სასურველი კომენტარი">
                    </div>
                    </div>
                </div>

                </div>`


                orderInfoContainer.innerHTML += orderInfoHTML

                // CREATE SECTOR SELECT
                const tomselect2 = document.querySelectorAll('.tomselect2')

                // initialize tomselect
                tomselect2.forEach((item, index) => {
                    // item.addEventListener('mouseover', () => {
                    item.innerHTML = '';
                    // item.setAttribute('id', `select-beast2${index}`)


                    // add Sector name and id From JSON
                    sectors.forEach((Sitem, Sindex) => {
                        let optionElement = document.createElement('option');
                        optionElement.value = Sitem['prices'][0]['price'] + '-' + Sitem['id'];
                        optionElement.textContent = '';
                        optionElement.textContent = Sitem.name + '-₾' + Sitem['prices'][0]['price'];
                        item.appendChild(optionElement);
                    })

                })


                const firstButton = document.querySelector(`.removes`)
                firstButton.click()


            }

            // delete each item and  make first addition active
            const deleteButton = document.querySelectorAll('.deleteButton')
            const removeButton = document.querySelectorAll(`.removeButton`)
            const removeInfo = document.querySelectorAll(`.removeInfo`)
            deleteButton.forEach((item, index) => {
                item.addEventListener('click', () => {
                    removeButton[index].remove();
                    removeInfo[index].remove();
                    const firstButton2 = document.querySelector(`.removes`)
                    firstButton2.classList.add('active')
                    const firstInfo2 = document.querySelector(`.removeInfo`)
                    firstInfo2.classList.remove('hidden')


                    // =================== დაჯამება წაშლისას  ================

                    const totalValue = document.getElementById('total_price')
                    const totalValue2 = document.getElementById('total_price2')

                    const prices = document.querySelectorAll('select.tomselect2')
                    let sum = 0;
                    prices.forEach((item, index) => {
                        var selectedOption = item.options[item.selectedIndex];
                        let content = selectedOption.text.slice(-2);

                        if (content.includes('₾')) {
                            content = selectedOption.text.slice(-1)
                        }

                        content = Number(content)
                        sum += content;
                        totalValue.value = sum;
                        totalValue2.value = sum;
                    })


                })
            })


            const totalValue3 = document.getElementById('total_price')
            const totalValue4 = document.getElementById('total_price2')
            const prices = document.querySelectorAll('select.deliveryprice ')

            prices.forEach((item, index) => {
                item.addEventListener('change', () => {
                    console.log('change')
                    totalValue3.value = '';
                    totalValue4.value = '';
                })

            })

        })


        // ============== ახალი ამანათის სათითაოდ დამატება ===============
        const addItem = document.getElementById("add-item")
        addItem.addEventListener('click', () => {

            let rand = Math.floor(Math.random() * 900) + 100

            const buttonHTML2 = `
         <button
          type="button"
          class="removeButton removes hs-tab-active:bg-white hs-tab-active:border-e-transparent hs-tab-active:text-primary dark:hs-tab-active:bg-transparent dark:hs-tab-active:border-e-gray-800 dark:hs-tab-active:text-primary -me-px py-2 px-3 inline-flex items-center gap-2 bg-gray-50 text-sm font-medium text-center border text-defaulttextcolor rounded-s-sm hover:text-primary dark:bg-black/20 dark:border-white/10 dark:text-[#8c9097] dark:text-white/50 dark:hover:text-gray-300
          "
          id="hs-tab-js-vertical-item-${rand}"
          data-hs-tab="#hs-tab-js-vertical-${rand}"
          aria-controls="hs-tab-js-vertical-${rand}"
        >
                <span class="material-symbols-outlined">
            package_2
            </span>
          </button>
           `;

            const orderInfoHTML2 =
                `<div id="hs-tab-js-vertical-${rand}"
                class="hidden removeInfo"
                role="tabpanel"
                aria-labelledby="hs-tab-js-vertical-item-${rand}">
                <div class="px-3">
                 <div class="flex justify-center mb-3">
                  <button type="button" style="margin-right:2rem" class="ti-btn ti-btn-light ti-btn-wave mr-2">ამანათი No: ${rand}</button>
                   <button type="button"  class="ti-btn ti-btn-danger ti-btn-wave deleteButton">წაშლა</button>
                 </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 text-center mt-2">
                        <label for="package-id${rand}" class="form-label">იდენტიფიკატორი</label>
                        <input  type="text" name="package-id[]" class="form-control validation" id="package-id${rand}" placeholder="ამანათის განმასხვავებელი (No ან სხვა)">
                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                        <label for="package-descr${rand}" class="form-label">აღწერა</label>
                        <input  type="text" name="package-descr[]" class="form-control validation" id="package-descr${rand}" placeholder="ამანათის შიგთვსის მოკლე აღწერა">
                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                        <label for="weight${rand}" class="form-label">წონა</label>
                        <input  type="text" name="weight[]" class="form-control validation" id="weight${rand}" placeholder="ამანათის წონა">
                    </div>
                     <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2 flex flex-col">
                        <label for="package_value${i}" class="form-label m-auto" >ამანათის ღირებულება</label>
                        <input style="width:100px;padding: 8px"  type="text" name="package_value[]" class="form-control validation m-auto" id="package_value${i}" placeholder="ღირებულება">
                    </div>
                      <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                        <label  class="form-label mt-2">მოცულობა</label>
                      <div class="sm:flex rounded-sm">
                        <input  type="text" name="length[]" class="validation ti-form-input rounded-none -mt-px -ms-px first:rounded-t-sm last:rounded-b-sm sm:first:rounded-s-sm sm:mt-0 sm:first:ms-0  sm:first:rounded-se-none  sm:last:rounded-es-none  sm:last:rounded-e-sm  relative focus:z-10" id="length${rand}" placeholder="სიგრძე სმ">
                        <input  type="text" name="width[]" class="validation ti-form-input rounded-none -mt-px -ms-px first:rounded-t-sm last:rounded-b-sm sm:first:rounded-s-sm sm:mt-0 sm:first:ms-0  sm:first:rounded-se-none  sm:last:rounded-es-none  sm:last:rounded-e-sm  relative focus:z-10" id="width${rand}" placeholder="სიგანე სმ">
                        <input  type="text" name="height[]" class="validation ti-form-input rounded-none -mt-px -ms-px first:rounded-t-sm last:rounded-b-sm sm:first:rounded-s-sm sm:mt-0 sm:first:ms-0  sm:first:rounded-se-none  sm:last:rounded-es-none  sm:last:rounded-e-sm  relative focus:z-10" id="height${rand}" placeholder="სიმაღლე სმ">
                    </div>
                      </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                        <label for="recipient${rand}" class="form-label">მიმღები</label>
                        <input  type="text" name="recipient[]" class="form-control validation" id="recipient${rand}" placeholder="მიმღების სახელი-გვარი">
                    </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                        <label for="recipient-mobile${rand}" class="form-label">მიმღების საკონტაქტო</label>
                        <input  type="tel" name="recipient-mobile[]" class="form-control validation" id="recipient-mobile${rand}" placeholder="მიმღების სახელი-გვარი">
                    </div>
                     <div class="box mt-3">
                          <div class="box-header">
                            <h5 class="box-title text-center">სექტორი და მისამართი</h5>
                          </div>
                          <div class="box">
                          <div class="flex gap-8 justify-center mt-4">
                                <select style='width:150px' name="sector[]" class="ti-form-select deliveryprice rounded-sm deliveryprice !p-0 tomselect3 validation"   autocomplete="off">
                                  <option value=""></option>
                                </select>
                                <input style="display:none" type="text" name="delivery_price[]" class="delivery_price">
                            </div>
                             <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                                <label for="recipient-address${i}" class="form-label">მისამართი</label>
                                <input  type="text" name="recipient-address[]" class="form-control validation" id="recipient-address${i}" placeholder="ჩაბარების მისამართი დეტალურად">
                            </div>
                          </div>
                        </div>
                    <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                        <label for="comment${rand}" class="form-label">დამატებითი შენიშვნა</label>
                        <input  type="text" name="comment[]" class="form-control" id="comment${rand}" placeholder="თქვენთვის სასურველი კომენტარი">
                    </div>
                    </div>
                </div>
                </div>`

            btnContainer.insertAdjacentHTML('beforeend', buttonHTML2);
            orderInfoContainer.insertAdjacentHTML('beforeend', orderInfoHTML2);


            // CREATE SECTOR SELECT
            const tomselect2 = document.querySelectorAll('.tomselect3');


            let lastItem;
            if (tomselect2.length > 0) {
                // Get the very last item
                lastItem = tomselect2[tomselect2.length - 1];
                sectors.forEach((Sitem) => {
                    let optionElement = document.createElement('option');
                    optionElement.value = Sitem['prices'][0]['price'] + '-' + Sitem['id'];
                    optionElement.textContent = '';
                    optionElement.textContent = Sitem.name + '-₾' + Sitem['prices'][0]['price'];
                    lastItem.appendChild(optionElement);
                })
            }


            //make first addition active
            const activeButtons = document.querySelector(`button.removes`)
            activeButtons.click()


            // delete Item
            const deleteButton2 = document.querySelectorAll('.deleteButton')
            const removeButton2 = document.querySelectorAll(`.removeButton`)
            const removeInfo2 = document.querySelectorAll(`.removeInfo`)
            deleteButton2.forEach((item, index) => {
                item.addEventListener('click', () => {
                    removeButton2[index].remove();
                    removeInfo2[index].remove();
                    const firstButton3 = document.querySelector(`.removes`)
                    firstButton3.classList.add('active')
                    const firstInfo3 = document.querySelector(`.removeInfo`)
                    firstInfo3.classList.remove('hidden')

                    // ======= დაჯამება წაშლისას ======

                    const totalValue = document.getElementById('total_price')
                    const totalValue2 = document.getElementById('total_price2')
                    const prices = document.querySelectorAll('select.tomselect3')

                    let sum2 = 0;

                    prices.forEach((item, index) => {
                        var selectedOption = item.options[item.selectedIndex];
                        let content = selectedOption.text.slice(-2);

                        if (content.includes('₾')) {
                            content = selectedOption.text.slice(-1)
                        }

                        content = Number(content)
                        sum2 += content;
                        totalValue.value = sum2;
                        totalValue2.value = sum2;

                    })


                })
            })


            const totalValue3 = document.getElementById('total_price')
            const totalValue4 = document.getElementById('total_price2')
            const prices = document.querySelectorAll('select.deliveryprice ')

            prices.forEach((item, index) => {
                item.addEventListener('change', () => {
                    console.log('change')
                    totalValue3.value = '';
                    totalValue4.value = '';
                })

            })

        })


        // =================  დაჯამება 2 ===============================

        const sumBtn = document.getElementById('sum')
        const totalValue = document.getElementById('total_price')
        const totalValue2 = document.getElementById('total_price2')


        sumBtn.addEventListener('click', () => {
            const prices = document.querySelectorAll('select.deliveryprice ')
            let sum = 0;

            prices.forEach((item, index) => {
                var selectedOption = item.options[item.selectedIndex];
                let content = selectedOption.text.slice(-2);

                if (content.includes('₾')) {
                    content = selectedOption.text.slice(-1)
                }

                content = Number(content)
                sum += content;
                totalValue.value = sum;
                totalValue2.value = sum;
            })

        })


        // =================== შეკვეთის ნომერი და ყველაფრის გასუფთავება =====================

        const clearAll = document.querySelector('.clearAll')
        const orderID = document.querySelector('#orderId')
        const orderID2 = document.querySelector('#orderId2')
        const randomNumber = Math.floor(Math.random() * 900) + 100;
        const randomLetters = Array.from({length: 2}, () =>
            String.fromCharCode(Math.floor(Math.random() * 26) + 65)
        );
        const randomString = `${randomLetters.join('')}-${randomNumber}`;
        orderID.value = randomString
        orderID2.value = randomString
        orderID.disabled = true

        clearAll.addEventListener('click', () => {
            document.querySelector('.btnContainer').innerHTML = ''
            document.querySelector('.orderInfoContainer').innerHTML = ''
            orderCount.value = '';
            orderCount.disabled = false
            totalValue.value = '';
        })


        // ================ მარტივი ვალიდაცია =============

        const orderForm = document.getElementById('orderForm')

        orderForm.addEventListener('submit', (e) => {
            e.preventDefault()

            document.querySelectorAll('.removeButton').forEach(button => {
                button.style = "color:gray"
            })

            // Select all divs with the class `removeInfo`
            const divs = Array.from(orderForm.querySelectorAll('div.removeInfo'));
            const emptyDivs = divs.filter(div => {
                const inputs = div.querySelectorAll('.validation');
                return Array.from(inputs).some(input => input.value === '');
            });

            console.log(emptyDivs)
            // For each empty div, find the corresponding button
            const removeButtons = emptyDivs.map(div => {
                // Search from the document root
                return document.querySelector(`button.removeButton[aria-controls="${div.id}"]`);
            }).filter(button => button !== null);


            console.log(removeButtons)
            removeButtons.forEach(button => {
                button.style = "color:red"
            })


            const inputs = orderForm.querySelectorAll('.validation')
            const emptyInputs = Array.from(inputs).filter(input => input.value === '');


            emptyInputs.forEach(input => {
                input.style.border = '1px solid red'
            })
            inputs.forEach(input => {
                input.addEventListener('input', () => {
                    input.style.border = '1px solid green';
                })
            })

            if (emptyInputs.length === 0) {
                orderForm.submit();
            }
        })

    </script>

@endif

{{--Dark Menu At Load--}}
<script>

    localStorage.setItem('ynexdarktheme', 'true');
    localStorage.setItem('ynexHeader', 'dark');
    const defaultTheme = {
        admin: "QR MENU",
        settings: {
            layout: {
                name: "Web Menu",
                toggle: false,
                darkMode: true,
                boxed: false
            }
        },
        reset: true
    };

    localStorage.setItem('theme', JSON.stringify(defaultTheme));
    localStorage.setItem('ynexMenu', 'dark');
    localStorage.setItem('layout-theme', 'dark');

</script>


{{--მომხმარებლის დამატების ფორმის ვალიდაცაი--}}
@if(request()->routeIs() == 'admin.users')
    <script>
        const userForm = document.getElementById('userForm')

        userForm.addEventListener('submit', (e) => {
            e.preventDefault()
            const inputs2 = userForm.querySelectorAll('.validation')
            const emptyInputs2 = Array.from(inputs2).filter(input => input.value === '');

            console.log(emptyInputs2)
            emptyInputs2.forEach(input => {
                input.style.border = '1px solid red'
            })
            inputs2.forEach(input => {
                input.addEventListener('input', () => {
                    input.style.border = '1px solid green';
                })
            })

            if (emptyInputs2.length === 0) {
                userForm.submit();
            }
        })


    </script>
@endif

{{--Datatable--}}
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>--}}
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
{{--<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>--}}
<script>
    document.addEventListener('DOMContentLoaded', () => {

        new DataTable('[data-datatable]', {
            scrollX: true,
            scrollY: 470,
            dom: 'Bfrtip',

            lengthMenu: [
                [10, 25, 50, -1],
                ['10', '25', '50', 'ყველა']
            ],
            buttons: ['pageLength', 'colvis', 'excel'],
            oSearch: {
                "bSmart": false,
                "bRegex": true,
                "sSearch": ""
            }
        });
    });

</script>
<!-- Tom Select-->
<script src="{{asset('assets/libs/tom-select/js/tom-select.complete.min.js')}}"></script>
{{--<script src="{{asset('assets/js/tom-select.js')}}"></script>--}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.courier-tomselect').forEach((el, i) => {
            new TomSelect("#select-beast" + i, {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        })

    })

</script>


<script>
    new TomSelect("#payment_select", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

</script>

{{--copy for driver--}}
<script>
    function myFunction() {
        // Get the text field
        let copyText = document.getElementById("address");

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

    }
</script>

{{--=====Edit Order Functioanality for Customers=====--}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const prices = document.querySelectorAll('.edit-select')


    })
</script>


{{--===========EDIT ORDER BY CUSTOMER===========--}}

{{--@if(request()->routeIs('order_customer_update'))--}}
<script>

    // Sum Functionality
    const sumBtn = document.getElementById('sum')
    const totalValue = document.getElementById('total_price')
    const totalValue2 = document.getElementById('total_price2')

    sumBtn.addEventListener('click', () => {
        const prices = document.querySelectorAll('select.delivery-price ')
        let sum = 0;

        prices.forEach((item, index) => {
            var selectedOption = item.options[item.selectedIndex];
            let content = parseFloat(selectedOption.getAttribute('data-price'));

            content = Number(content)
            sum += content;
            totalValue.value = sum;
            totalValue2.value = sum;
        })
        console.log(totalValue2.value)
    })

    // If changed location then clear sum
    const prices2 = document.querySelectorAll('select.delivery-price ')
    prices2.forEach(select => {
        select.addEventListener('change', () => {
            totalValue.value = '';
            totalValue2.value = '';
        })
    })

    // Delete Item Functionality
    const deleteButton = document.querySelectorAll('.deleteButton')
    const deleteitemform = document.getElementById('deleteitemform')
    const item_input = document.getElementById('item-input')

    deleteButton.forEach((button, index) => {
        button.addEventListener('click', () => {
            item_input.value = button.getAttribute('data-itemId')
            console.log(item_input.value)
            totalValue.value = '';
            totalValue2.value = '';
            deleteitemform.submit()
        })
    })


    // Edit Order Validation

    const orderForm = document.getElementById('orderForm')

    orderForm.addEventListener('submit', (e) => {
        e.preventDefault()

        document.querySelectorAll('.removeButton').forEach(button => {
            button.style = "color:gray"
        })

        // Select all divs with the class `removeInfo`
        const divs = Array.from(orderForm.querySelectorAll('div.removeInfo'));
        const emptyDivs = divs.filter(div => {
            const inputs = div.querySelectorAll('.validation');
            return Array.from(inputs).some(input => input.value === '');
        });

        console.log(emptyDivs)
        // For each empty div, find the corresponding button
        const removeButtons = emptyDivs.map(div => {
            // Search from the document root
            return document.querySelector(`button.removeButton[aria-controls="${div.id}"]`);
        }).filter(button => button !== null);


        console.log(removeButtons)
        removeButtons.forEach(button => {
            button.style = "color:red"
        })


        const inputs = orderForm.querySelectorAll('.validation')
        const emptyInputs = Array.from(inputs).filter(input => input.value === '');


        emptyInputs.forEach(input => {
            input.style.border = '1px solid red'
        })
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                input.style.border = '1px solid green';
            })
        })

        if (emptyInputs.length === 0) {
            orderForm.submit();
        }
    })







</script>
{{--@endif--}}


{{--===========RECEIVE SSE===========--}}
<script>
    const eventSource = new EventSource("{{ route('stream') }}");

    eventSource.onmessage = function (event) {


        if (parseInt(event.data) > 0) {
            // document.getElementById('notification-sound').play();
            document.getElementById('badge').style.display = 'block';
            document.getElementById('notification-icon-badge2').textContent = event.data;
        }

    };
</script>


</body>

</html>
