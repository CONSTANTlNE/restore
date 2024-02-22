@extends('main-layout')
@php
    //dd($order);
@endphp



@section('customer-order-edit')

{{--    Delete Item Form--}}
    <form id="deleteitemform"
          action="{{route('order_item_delete_bycustomer')}}" method="post">
        @csrf
        <input id="item-input" type="hidden" value="" name="id">
        <input  type="hidden" value="{{$order->id}}" name="order_id">
        <button style="display: none" id="item-delete-btn"
                class="ti-btn ti-btn-danger ti-btn-wave">
        </button>
    </form>

    <div  class="hs-overlay ti-modal [--overlay-backdrop:static] open">
        <div style="max-width: 40rem!important"
             class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
            <form id="orderForm" method="post" action="{{route('order_customer_update')}}">
                @csrf
                <input type="hidden" name="order_id" value="{{$order->id}}">
                <div class="ti-modal-content">
                    <div class="ti-modal-header orerHeader ">
                        <div class="flex justify-center order-header m-auto">

                            <div class="flex justify-center">
                                <h6 style="width:100px;margin-right: 2rem;text-align: center"
                                    class="modal-title ggggg text-[1rem] font-semibold">
                                    შეკვეთის
                                    ნომერი:</h6>

                                <input value="{{$order->order}}" class="form-control"
                                       id="orderId" type="text"
                                       style="width:80px;border:1px solid white;padding-right: 6px;padding-left: 6px;text-align: center">
                            </div>
                            <input type="hidden" class="form-control"
                                   id="orderId"
                                   name="orderId"
                                   value="{{$order->order}}"
                                   style="width:80px;border:1px solid white;">
                        </div>

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

                                        @foreach($order->items as $index2 => $item1)
                                            <button
                                                    type="button"
                                                    class="removeButton removes hs-tab-active:bg-white hs-tab-active:border-e-transparent hs-tab-active:text-primary dark:hs-tab-active:bg-transparent dark:hs-tab-active:border-e-gray-800 dark:hs-tab-active:text-primary -me-px py-2 px-3 inline-flex items-center gap-2 bg-gray-50 text-sm font-medium text-center border text-defaulttextcolor rounded-s-sm hover:text-primary dark:bg-black/20 dark:border-white/10 dark:text-[#8c9097] dark:text-white/50 dark:hover:text-gray-300"
                                                    id="hs-tab-js-vertical-item-{{$item1->id}}"
                                                    data-hs-tab="#hs-tab-js-vertical-{{$item1->id}}"
                                                    aria-controls="hs-tab-js-vertical-{{$item1->id}}">
                                                                                    <span class="material-symbols-outlined">
                                                                                    package_2
                                                                                    </span>
                                            </button>
                                        @endforeach
                                    </nav>
                                </div>

                                <div class="orderInfoContainer">
                                    @foreach($order->items as $index3 => $item2)
                                        <div id="hs-tab-js-vertical-{{$item2->id}}"
                                             class="removeInfo"
                                             role="tabpanel"
                                             aria-labelledby="hs-tab-js-vertical-item-{{$item2->id}}">
                                            <div class="px-3">
                                                <div class="flex justify-center mb-3">
                                                        <button type="button" data-itemId="{{$item2->id}}"
                                                                class="ti-btn ti-btn-danger ti-btn-wave deleteButton">
                                                            წაშლა
                                                        </button>
                                                </div>
                                                <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 text-center">
                                                    <label for="package-id{{$index3}}"
                                                           class="form-label">იდენტიფიკატორი</label>
                                                    <br>
                                                    <input type="text"
                                                           name="package-id[]"
                                                           class="form-control validation"
                                                           id="package-id{{$index3}}"
                                                           placeholder="ამანათის განმასხვავებელი (No ან სხვა)"
                                                           value="{{$item2->package_id}}">
                                                </div>
                                                <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                                                    <label for="package-descr{{$index3}}"
                                                           class="form-label">აღწერა</label>
                                                    <br>
                                                    <input value="{{$item2->description}}"
                                                           type="text"
                                                           name="package-descr[]"
                                                           class="form-control validation"
                                                           id="package-descr{{$index3}}"
                                                           placeholder="ამანათის შიგთვსის მოკლე აღწერა"
                                                    >
                                                </div>
                                                <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                                                    <label for="weight${i}"
                                                           class="form-label">წონა</label>
                                                    <br>
                                                    <input type="text" name="weight[]"
                                                           class="form-control validation"
                                                           id="weight${i}"
                                                           placeholder="ამანათის წონა"
                                                           value="{{$item2->weight}}">
                                                </div>
                                                <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2 flex flex-col">
                                                    <label for="package_value${i}"
                                                           class="form-label m-auto">ამანათის
                                                        ღირებულება</label>
                                                    <br>
                                                    <input style="width:100px;padding: 8px"
                                                           type="text"
                                                           name="package_value[]"
                                                           class="form-control validation m-auto"
                                                           id="package_value${i}"
                                                           placeholder="ღირებულება"
                                                           value="{{$item2->item_value}}">
                                                </div>
                                                <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                                                    <label class="form-label mt-2">მოცულობა</label>
                                                    <br>
                                                    <div class="sm:flex rounded-sm">
                                                        <input type="text"
                                                               name="length[]"
                                                               class="validation ti-form-input rounded-none -mt-px -ms-px first:rounded-t-sm last:rounded-b-sm sm:first:rounded-s-sm sm:mt-0 sm:first:ms-0  sm:first:rounded-se-none  sm:last:rounded-es-none  sm:last:rounded-e-sm  relative focus:z-10"
                                                               id="length${i}"
                                                               placeholder="სიგრძე სმ"
                                                               value="{{$item2->length}}">

                                                        <input type="text"
                                                               name="width[]"
                                                               class="validation ti-form-input rounded-none -mt-px -ms-px first:rounded-t-sm last:rounded-b-sm sm:first:rounded-s-sm sm:mt-0 sm:first:ms-0  sm:first:rounded-se-none  sm:last:rounded-es-none  sm:last:rounded-e-sm  relative focus:z-10"
                                                               id="width${i}"
                                                               placeholder="სიგანე სმ"
                                                               value="{{$item2->width}}">
                                                        <input type="text"
                                                               name="height[]"
                                                               class="validation ti-form-input rounded-none -mt-px -ms-px first:rounded-t-sm last:rounded-b-sm sm:first:rounded-s-sm sm:mt-0 sm:first:ms-0  sm:first:rounded-se-none  sm:last:rounded-es-none  sm:last:rounded-e-sm  relative focus:z-10"
                                                               id="height${i}"
                                                               placeholder="სიმაღლე სმ"
                                                               value="{{$item2->height}}">
                                                    </div>
                                                </div>
                                                <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                                                    <label for="recipient${i}"
                                                           class="form-label">მიმღები</label>
                                                    <br>
                                                    <input type="text"
                                                           name="recipient[]"
                                                           class="form-control validation"
                                                           id="recipient${i}"
                                                           placeholder="მიმღების სახელი-გვარი"
                                                           value="{{$item2->receiver}}">
                                                </div>
                                                <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                                                    <label for="recipient-mobile${i}"
                                                           class="form-label">მიმღების
                                                        საკონტაქტო</label>
                                                    <br>
                                                    <input type="tel"
                                                           name="recipient-mobile[]"
                                                           class="form-control validation"
                                                           id="recipient-mobile${i}"
                                                           placeholder="მიმღების მობილურის ნომერი"
                                                           value="{{$item2->receiver_phone}}">
                                                </div>
                                                <div class="box mt-3">
                                                    <div class="box-header">
                                                        <h5 class="box-title text-center">
                                                            სექტორი და მისამართი</h5>
                                                    </div>
                                                    <div class="box">
                                                        <div class="flex gap-8 justify-center mt-4">
                                                            <select style='width:150px'
                                                                    name="sector[]"
                                                                    class="ti-form-select rounded-sm !p-0 edit-select  delivery-price"
                                                                    autocomplete="off">
                                                                @foreach($sectors as $sector)
                                                                    @if($sector->id===$item2->sector_id)
                                                                        <option data-price="{{$sector->prices->last()->price}}"
                                                                                value="{{$sector->prices->last()->price}}-{{$item2->sector_id}}">
                                                                            {{$sector->name}}-{{$sector->prices->last()->price}}₾</option>
                                                                    @endif
                                                                @endforeach

                                                                @foreach($sectors as $sector)
                                                                    <option data-price="{{$sector->prices->last()->price}}"
                                                                            value="{{$sector->prices->last()->price}}-{{$sector->id}}">{{$sector->name}}-{{$sector->prices->last()->price}}₾</option>
                                                                @endforeach
                                                            </select>


                                                        </div>
                                                        <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                                                            <label for="recipient-address${i}"
                                                                   class="form-label">მისამართი</label>
                                                            <br>
                                                            <input type="text"
                                                                   name="recipient-address[]"
                                                                   class="form-control validation"
                                                                   id="recipient-address${i}"
                                                                   placeholder="ჩაბარების მისამართი დეტალურად"
                                                                   value="{{$item2->receiver_address}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2">
                                                    <label for="comment${i}"
                                                           class="form-label">დამატებითი
                                                        შენიშვნა</label>
                                                    <br>
                                                    <input type="text" name="comment[]"
                                                           class="form-control"
                                                           id="comment${i}"
                                                           placeholder="თქვენთვის სასურველი კომენტარი"
                                                           value="{{$item2->customer_comment}}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="border-bottom: rgb(255 255 255 / 0.1) solid 1px"
                         class="flex justify-center mt-3 pb-3">
                        <button id="sum" style="margin-right:1rem;margin-bottom: 0"
                                type="button"
                                class="ti-btn ti-btn-outline-light ti-btn-wave">დაჯამება
                        </button>
                        <input type="hidden" class="form-control validation"
                               name="sum_value2"
                               id="total_price2"
                               style="width:80px;border:1px solid white;padding-right: 6px;padding-left: 6px;text-align: center">
                        <input disabled class="form-control validation" name="sum_value"
                               id="total_price"
                               type="text"
                               value=""
                               style="width:80px;border:1px solid white;padding-right: 6px;padding-left: 6px;text-align: center">
                    </div>
                    <div class="ti-modal-footer">
                        <a href="{{route('customer-index')}}"
                           class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                           data-hs-overlay="#staticBackdrop">
                            გაუქმება
                        </a>
                        <button class="ti-btn bg-primary text-white !font-medium">
                            ცვლილება
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection