<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" class="dark" data-header-styles="dark" data-menu-styles="dark">
@php
    //        dd($jsonSectors)
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> RESTORE </title>
    <meta name="description"
          content="A Tailwind CSS admin template is a pre-designed web page for an admin dashboard. Optimizing it for SEO includes using meta descriptions and ensuring it's responsive and fast-loading.">
    <meta name="keywords"
          content="html dashboard,tailwind css,tailwind admin dashboard,template dashboard,html and css template,tailwind dashboard,tailwind css templates,admin dashboard html template,tailwind admin,html panel,template tailwind,html admin template,admin panel html">

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
    @include('components.header')
    <!-- End::Header -->
    <!-- Start::app-sidebar -->
    @include('components.sidebar')
    <!-- End::app-sidebar -->


    <!-- Start::content  -->
    <div class="content">
        <!-- Start::main-content -->
        <div class="main-content">

            <button hx-get="/test/items" hx-target="#target" replace="true" class="ti-btn ti-btn-light !rounded-full ti-btn-wave">
              button
            </button>


            <div id="target"  class="grid grid-cols-12 gap-6 mt-3">

            </div>


        </div>
    </div>
    <!-- End::content  -->

    <!-- ========== Search Modal ========== -->
    @include('components.searchModal')
    <!-- ========== END Search Modal ========== -->

    <!-- Footer Start -->
    @include('components.footer')
    <!-- Footer End -->

</div>





<script src="https://unpkg.com/htmx.org@1.9.10" ></script>
<!-- Back To Top -->
<div class="scrollToTop">
    <span class="arrow"><i class="ri-arrow-up-s-fill text-xl"></i></span>
</div>

<div id="responsive-overlay"></div>

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
                        <label for="package_value${i}" class="form-label m-auto" ">ამანათის ღირებულება</label>
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
                                <select style='width:150px' name="sector[]" class="ti-form-select rounded-sm !p-0 tomselect2"   autocomplete="off">
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
                    item.setAttribute('id', `select-beast2${index}`)

                    // add Sector name and id From JSON
                    sectors.forEach((Sitem) => {
                        let optionElement = document.createElement('option');
                        optionElement.value = Sitem.id;
                        optionElement.textContent = '';
                        optionElement.textContent = Sitem.name + '-₾' + Sitem['prices'][0]['price'];
                        item.appendChild(optionElement);
                    })

                    // new TomSelect(`#select-beast2${index}`, {
                    //     create: true,
                    //     sortField: {
                    //         field: "text",
                    //         direction: "asc"
                    //     }
                    // });

                    // })
                })


                const firstButton = document.querySelector(`.removes`)
                firstButton.click()


            }
            //disable input field
            // orderCount.disabled = true

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


                    // =================== დაჯამება  ================

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
                    })


                })
            })


        })


        // ==============ახალი ამანათის სათითაოდ დამატება===============
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
                                <select style='width:150px' name="sector[]" class="ti-form-select rounded-sm !p-0 tomselect3 validation"   autocomplete="off">
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
                    optionElement.value = Sitem.id;
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

                    // ======= დაჯამება  ======

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
        })


        //=================  დაჯამება  ==================

        const sumBtn = document.getElementById('sum')
        const totalValue = document.getElementById('total_price')
        const totalValue2 = document.getElementById('total_price2')


        sumBtn.addEventListener('click', () => {
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
        })


        // ================ მარტივი ვალიდაცია =============

        const orderForm = document.getElementById('orderForm')

        orderForm.addEventListener('submit', (e) => {
            e.preventDefault()
            const inputs = orderForm.querySelectorAll('.validation')
            const emptyInputs = Array.from(inputs).filter(input => input.value === '');

            console.log(emptyInputs)
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
</body>

</html>
