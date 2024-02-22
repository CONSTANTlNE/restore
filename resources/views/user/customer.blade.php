@extends('main-layout')
@php

//dd($service_prices);
 @endphp
@section('customer-orders')
    <div class="block justify-center page-header md:flex" style="padding-top: 0;padding-bottom: 0">
        <div>
            <div class="box-body flex justify-center m">
                <a
                        @if($balance->total_amount>0)
                            style="background: black!important;margin-right: 20px;color:green"
                        @else style="background: black!important;margin-right: 20px;color:red"
                        @endif
                        href="{{route('customer_balance_details')}}"
                        class="hs-dropdown-toggle ti-btn border-primary">
                    ბალანსი: {{$balance->total_amount}}
                </a>
                <a href="javascript:void(0);" style="background: black!important;margin-right: 20px"
                   class="hs-dropdown-toggle ti-btn border-primary" data-hs-overlay="#prices">
                    ფასები
                </a>
                <div id="prices" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                        <div class="ti-modal-content">
                            <div class="ti-modal-header">
                                <h6 class="modal-title text-[1rem] font-semibold">საკურიერო ფასები</h6>
                                <button type="button"
                                        class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                        data-hs-overlay="#prices">
                                    <span class="sr-only">Close</span>
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                            <div style="padding:5px" class="ti-modal-body ">
                                <div class="table-responsive">
                                    <table class="table whitespace-nowrap table-bordered table-bordered-primary border-primary/10 min-w-full">
                                        <thead>
                                        <tr class="border-b border-primary/10">

                                            <th class="text-start">სექტორი</th>
                                            <th class="text-start">მისამართი</th>
                                            <th class="text-start">ფასი</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sectors as $sector)
                                            <tr class="border-b border-primary/10">
                                                <td>{{$sector->name}}</td>
                                                <td>{{$sector->address}}</td>
                                                <td>{{$sector->prices->sortByDesc('created_at')->first()->price}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="ti-modal-footer">
                                <button type="button"
                                        class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                        data-hs-overlay="#prices
              "> OK
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{--=================== შეკვეთა ===================--}}
                @if(auth()->user()->active===1)
                <a href="javascript:void(0);" style="background: black!important"
                   class="hs-dropdown-toggle ti-btn border-primary" data-hs-overlay="#staticBackdrop">ახალი
                    შეკვეთა
                </a>
                    <div id="staticBackdrop" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                        <div style="max-width: 40rem!important"
                             class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                            <form id="orderForm" method="post" action="{{route('order.store')}}">
                                @csrf
                                <div class="ti-modal-content">
                                    <div class="ti-modal-header orerHeader ">
                                        <div class="flex justify-center order-header">
                                            <div class="flex justify-center orderQty">
                                                <h6 style="width:100px;text-align: center"
                                                    class="ggggg2 modal-title text-[1rem] font-semibold">
                                                    ამანათის რაოდენობა:</h6>
                                                <input class=" orderCount form-control"
                                                       style="width:50px;border:1px solid white">
                                            </div>
                                            <div class="flex justify-center orderNo">
                                                <h6 style="width:100px;margin-left: 2rem;text-align: center"
                                                    class="modal-title ggggg text-[1rem] font-semibold">შეკვეთის
                                                    ნომერი:</h6>
                                                <input class="form-control" id="orderId" type="text"
                                                       style="width:80px;border:1px solid white;padding-right: 6px;padding-left: 6px;text-align: center">
                                            </div>
                                            <input type="hidden" class="form-control" id="orderId2" name="orderId"
                                                   style="width:80px;border:1px solid white;">

                                        </div>

                                        <button style="margin-bottom: 0;margin-left:1rem" type="button"
                                                class="ti-btn ti-btn-danger ti-btn-wave clearAll">გასუფთავება
                                        </button>
                                        <button style="display: none" type="button"
                                                class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                data-hs-overlay="#staticBackdrop">
                                            <span class="sr-only">Close</span>
                                            <i class="ri-close-line"></i>
                                        </button>

                                    </div>

                                    <div class="box">

                                        <div class="box-body"
                                             style="padding-left:0!important;padding-right: 0!important">
                                            <div class="flex">
                                                <div class="border-e border-gray-200 dark:border-white/10">
                                                    <nav class="flex flex-col space-y-2 whitespace-nowrap btnContainer"
                                                         aria-label="Tabs" data-hs-tabs-vertical="true">
                                                        {{--Buttons Goes Here--}}
                                                    </nav>
                                                </div>

                                                <div class="orderInfoContainer">
                                                    {{--order details goes here--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="border-bottom: rgb(255 255 255 / 0.1) solid 1px"
                                         class="flex justify-center mt-3 pb-3">
                                        <button id="sum" style="margin-right:1rem;margin-bottom: 0" type="button"
                                                class="ti-btn ti-btn-outline-light ti-btn-wave">დაჯამება
                                        </button>
                                        <input type="hidden" class="form-control validation" name="sum_value2"
                                               id="total_price2"
                                               style="width:80px;border:1px solid white;padding-right: 6px;padding-left: 6px;text-align: center">
                                        <input disabled class="form-control validation" name="sum_value" id="total_price"
                                               type="text"
                                               style="width:80px;border:1px solid white;padding-right: 6px;padding-left: 6px;text-align: center">
                                    </div>
                                    <div class="ti-modal-footer">
                                        <button type="button" id="add-item" class="ti-btn ti-btn-success-full ti-btn-wave">
                                            დამატება
                                        </button>
                                        <button type="button"
                                                class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                data-hs-overlay="#staticBackdrop">
                                            დახურვა
                                        </button>
                                        <button class="ti-btn bg-primary text-white !font-medium">
                                            შეკვეთა
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <button type="button" class="ti-btn bg-primary text-white my-1 me-2">
                        არააქტიური ანგარიში
                    </button>
                @endif

            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">შეკვეთები</h5>
                </div>
                <div class="box-body space-y-3">
                    <table id="TableToExport" data-datatable class="display nowrap" style="width:100%;">
                        <thead>
                        <tr>
                            <th class="th-center">თარიღი</th>
                            <th class="th-center">შეკვეთის No</th>
                            <th class="th-center">სრული ღირებულება</th>
                            <th class="th-center">ამანათის რაოდენობა</th>
                            <th class="th-center">სტატუსი</th>
                            <th class="th-center">წაშლა</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $index => $order)
                            {{--                            @php dd($order) @endphp--}}
                            <tr style="text-align: center">
                                <td style="width: 90px!important; white-space:normal">{{$order->created_at}}</td>
                                <td>{{$order->order}}</td>
                                <td>{{$order->sum_value}}</td>
                                <td>{{ $order->item_count }}</td>
                                <td>
                                    @if($order->status===0)
                                        <p style="color:gold">მუშავდება</p>
                                    @else
                                        <p style="color:green">დადასტურებული</p>
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0);"
                                       class="hs-dropdown-toggle ti-btn border-primary"
                                       data-hs-overlay="#staticBackdrop2{{$index}}">
                                        <span style="color:red" class="material-symbols-outlined">delete</span>
                                    </a>
                                    <div id="staticBackdrop2{{$index}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <form id="orderForm" method="post"
                                                  action="{{route('customer-order-delete')}}">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$order->id}}">
                                                <div class="ti-modal-content">
                                                    <div class="ti-modal-header orerHeader ">

                                                        <button style="display: none" type="button"
                                                                class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                                data-hs-overlay="#staticBackdrop{{$index}}">
                                                            <span class="sr-only">Close</span>
                                                            <i class="ri-close-line"></i>
                                                        </button>
                                                    </div>
                                                    <div class="ti-modal-content"
                                                         style="padding-left:0!important;padding-right: 0!important">
                                                        <div class="order-header">
                                                            @if($order->status===0)
                                                                <div class="ti-modal-body px-4">
                                                                    <h6 style="width:100px;text-align: center"
                                                                        class=" modal-title text-[1rem] font-semibold">
                                                                        დარწმუნებული ხართ?
                                                                    </h6>
                                                                    <br>
                                                                    <p style="color:red">შეკვეთაში არსებული ყველა
                                                                        ამანათი წაიშლება
                                                                    </p>
                                                                </div>
                                                            @else
                                                                <div class="ti-modal-body px-4">
                                                                    <h6 style="width:100px;text-align: center"
                                                                        class=" modal-title text-[1rem] font-semibold">
                                                                        შეკვეთა დამუშავებულია</h6>
                                                                    <br>
                                                                    <p style="color:red;">შეკვეთაში არსებული ყველა
                                                                        ცვლილებებისათვის
                                                                    </p>
                                                                    <p style="color:red;">გთხოვთ მიმართოთ ოპერატორს</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="ti-modal-footer">
                                                        <button type="button"
                                                                class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                                data-hs-overlay="#staticBackdrop2{{$index}}">
                                                            გაუქმება
                                                        </button>
                                                        @if($order->status===0)
                                                            <button class="ti-btn bg-primary text-white !font-medium">
                                                                წაშლა
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- ===========  ნახვა რედაქტირება  =============== --}}
                                    <a href="{{route('customer_order_edit',[$order->id])}}" class="hs-dropdown-toggle2 ti-btn border-primary" >
                                        <span style="color:blue" class="material-symbols-outlined">edit</span>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection  