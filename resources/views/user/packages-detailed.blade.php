@extends('main-layout')

@section('customer-packages')

    <div class="grid grid-cols-12 gap-6 mt-3 h-full">
        @if(session('error_item'))

            <div class="alert alert-danger flex justify-center  col-span-12 " role="alert">
                {{session('error_item')}}
            </div>
        @endif
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">ამანათები</h5>
                </div>
                <div class="box-body ">
                    <table id="TableToExport" data-datatable class="display nowrap" style="width:100%;">
                        <thead>
                        <tr>
                            <th class="th-center">თარიღი</th>
                            <th class="th-center">შეკვეთის No</th>
                            <th class="th-center">იდენტიფიკატორი</th>
                            <th class="th-center">აღწერა</th>
                            <th class="th-center">წონა</th>
                            <th class="th-center">მოცულობა</th>
                            <th class="th-center">მიმღები</th>
                            <th class="th-center">საკონტაქტო</th>
                            <th class="th-center">ამანათის ღირებულება</th>
                            <th class="th-center">მისამართი</th>
                            <th class="th-center">სექტორი</th>
                            <th class="th-center">საკურიერო</th>
                            <th class="th-center">სტატუსი</th>
                            <th class="th-center">ჩემი კომენტარი</th>
                            <th class="th-center">მოქმედება</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $index => $order)
                            {{--@php dd($item) @endphp--}}
                            @foreach($order->items as $index2=>$item)
                                <tr style="text-align: center">
                                    <td style="min-width: 90px!important; white-space:normal">{{$order->created_at}}</td>
                                    <td>{{$order->order}}</td>
                                    <td>{{$item->package_id}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->weight}}</td>
                                    <td>
                                        <p>სიგრძე: {{$item->length}}</p>
                                        <p>სიგანე: {{$item->width}}</p>
                                        <p>სიმაღლე: {{$item->height}}</p>
                                    </td>
                                    <td>{{$item->receiver}}</td>
                                    <td>{{$item->receiver_phone}}</td>
                                    <td>{{$item->item_value}}</td>
                                    <td>{{$item->receiver_address}}</td>
                                    <td>
                                        @foreach($sectors as $sector)
                                            @if($sector->id===$item->sector_id)
                                                {{$sector->name}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        {{$item->delivery_price}}

                                    </td>
                                    <td>

                                        @if($item->status===0)
                                            <p style="color:red">ჩასაბარებელი</p>
                                        @else
                                            <p style="color:green">ჩაბარებული</p>
                                        @endif
                                    </td>
                                    <td>{{$item->cutsomer_comment}}</td>
                                    <td>
                                        {{--წაშლა--}}
                                        <a href="javascript:void(0);"
                                           class="hs-dropdown-toggle ti-btn border-primary"
                                           data-hs-overlay="#staticBackdrop{{$index}}">
                                            <span style="color:red" class="material-symbols-outlined">delete</span>
                                        </a>
                                        <div id="staticBackdrop{{$index}}"
                                             class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                            <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                                <form id="orderForm{{$index}}" method="post"
                                                      action="{{route('customer-items-delete')}}">
                                                    @csrf
                                                    <input style="display: none" value="{{$item->id}}" name="id">
                                                    <input style="display: none" name="order_id" value="{{$item->order_id}}">

                                                    <div class="ti-modal-content">
                                                        <div class="ti-modal-header orerHeader ">
                                                            <button style="display: none" type="button"
                                                                    class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                                    data-hs-overlay="#staticBackdrop">
                                                                <span class="sr-only">Close</span>
                                                                <i class="ri-close-line"></i>
                                                            </button>
                                                        </div>

                                                            <div class="ti-modal-content"
                                                                 style="padding-left:0!important;padding-right: 0!important">
                                                                <div class="flex justify-center order-header">
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
                                                                            <p style="color:red;" >გთხოვთ მიმართოთ ოპერატორს</p>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        <div class="ti-modal-footer">
                                                            <button type="button"
                                                                    class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                                    data-hs-overlay="#staticBackdrop{{$index}}">
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
                                        {{--რედაქტირება--}}

                                        <a href="javascript:void(0);"
                                           class="hs-dropdown-toggle ti-btn border-primary"
                                           @if($order->status===0)
                                           data-hs-overlay="#staticBackdrop2{{$index}}"
                                        @else
                                               data-hs-overlay="#staticBackdrop{{$index}}"
                                                @endif
                                        >
                                            <span style="color:blue" class="material-symbols-outlined">edit</span>
                                        </a>

                                        <div id="staticBackdrop2{{$index}}"
                                             class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                            <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                                <form action="{{route('customer-items-update')}}" method="post">
                                                    @csrf
                                                    <input style="display: none" value="{{$item->id}}" name="id">
                                                    <input style="display: none" name="order_id" value="{{$item->order_id}}">
                                                <div class="ti-modal-content">
                                                    <div class="ti-modal-header">
                                                        <h6 class="modal-title text-[1rem] font-semibold">ამანათის
                                                            რედაქტირება</h6>
                                                        <button type="button"
                                                                class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                                data-hs-overlay="#staticBackdrop2{{$index}}">
                                                            <span class="sr-only">Close</span>
                                                            <i class="ri-close-line"></i>
                                                        </button>
                                                    </div>
                                                    <div class="ti-modal-body px-4">
                                                        <div class="px-3">
                                                            <div class="flex justify-center mb-3">
                                                                <button style="margin-right:2rem" type="button"
                                                                        class="ti-btn ti-btn-light ti-btn-wave mr-2">
                                                                    ამანათი No
                                                                </button>
                                                            </div>
                                                            <div class="flex flex-col mt-2">
                                                                <label for="package_id" class="form-label">იდენტიფიკატორი</label>
                                                                <input value="{{$item->package_id}}" type="text"
                                                                       name="package_id" class="form-control validation"
                                                                       id="package_id"
                                                                       placeholder="ამანათის განმასხვავებელი (No ან სხვა)">
                                                            </div>
                                                            <div class="flex flex-col mt-2">
                                                                <label for="package_descr"
                                                                       class="form-label">აღწერა</label>
                                                                <input value="{{$item->description}}" type="text"
                                                                       name="package_descr"
                                                                       class="form-control validation"
                                                                       id="package_descr"
                                                                       placeholder="ამანათის შიგთვსის მოკლე აღწერა">
                                                            </div>
                                                            <div class="flex flex-col mt-2">
                                                                <label for="weight" class="form-label">წონა</label>
                                                                <input value="{{$item->weight}}" type="text"
                                                                       name="weight" class="form-control validation"
                                                                       id="weight" placeholder="ამანათის წონა">
                                                            </div>
                                                            <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12 pt-2 text-center mt-2 flex flex-col">
                                                                <label for="package_value" class="form-label m-auto" >ამანათის ღირებულება</label>
                                                                <input value="{{$item->item_value}}"  style="width:100px;padding: 8px"  type="text" name="package_value" class="form-control validation m-auto" id="package_value" placeholder="ღირებულება">
                                                            </div>
                                                            <div class="flex flex-col mt-2">
                                                                <label class="form-label mt-2">მოცულობა</label>
                                                                <div class="sm:flex rounded-sm">
                                                                    <input value="{{$item->length}}" type="text"
                                                                           name="length"
                                                                           class="validation ti-form-input rounded-none -mt-px -ms-px first:rounded-t-sm last:rounded-b-sm sm:first:rounded-s-sm sm:mt-0 sm:first:ms-0  sm:first:rounded-se-none  sm:last:rounded-es-none  sm:last:rounded-e-sm  relative focus:z-10"
                                                                           id="length${i}" placeholder="სიგრძე სმ">
                                                                    <input value="{{$item->width}}" type="text"
                                                                           name="width"
                                                                           class="validation ti-form-input rounded-none -mt-px -ms-px first:rounded-t-sm last:rounded-b-sm sm:first:rounded-s-sm sm:mt-0 sm:first:ms-0  sm:first:rounded-se-none  sm:last:rounded-es-none  sm:last:rounded-e-sm  relative focus:z-10"
                                                                           id="width${i}" placeholder="სიგანე სმ">
                                                                    <input value="{{$item->height}}" type="text"
                                                                           name="height"
                                                                           class="validation ti-form-input rounded-none -mt-px -ms-px first:rounded-t-sm last:rounded-b-sm sm:first:rounded-s-sm sm:mt-0 sm:first:ms-0  sm:first:rounded-se-none  sm:last:rounded-es-none  sm:last:rounded-e-sm  relative focus:z-10"
                                                                           id="height${i}" placeholder="სიმაღლე სმ">
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col mt-2">
                                                                <label for="recipient"
                                                                       class="form-label">მიმღები</label>
                                                                <input value="{{$item->receiver}}" type="text"
                                                                       name="recipient" class="form-control validation"
                                                                       id="recipient"
                                                                       placeholder="მიმღების სახელი-გვარი">
                                                            </div>
                                                            <div class="flex flex-col mt-2">
                                                                <label for="recipient-mobile" class="form-label">მიმღების
                                                                    საკონტაქტო</label>
                                                                <input value="{{$item->receiver_phone}}" type="tel"
                                                                       name="recipient_mobile"
                                                                       class="form-control validation"
                                                                       id="recipient_mobile"
                                                                       placeholder="მიმღების მობილურის ნომერი">
                                                            </div>
                                                            <div class="box mt-3">
                                                                <div class="box-header">
                                                                    <h5 class="box-title text-center">სექტორი და
                                                                        მისამართი</h5>
                                                                </div>
                                                                <div class="box">
                                                                    <div class="flex gap-8 justify-center mt-4">
                                                                        <select style='width:150px' name="sector"
                                                                                class="ti-form-select rounded-sm !p-0 tomselect2"
                                                                                autocomplete="off">
                                                                            <option value="{{$item->sector_id}}">
                                                                                @foreach($sectors as $sector)
                                                                                    @if($sector->id == $item->sector_id)
                                                                                        {{$sector->name}}
                                                                                    @endif

                                                                                @endforeach
                                                                            </option>
                                                                            @foreach($sectors as $sector)
                                                                                <option value="{{$sector->id}}">{{$sector->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="flex flex-col mt-2">
                                                                        <label for="recipient_address$"
                                                                               class="form-label">მისამართი</label>
                                                                        <input value="{{$item->receiver_address}}"
                                                                               type="text" name="recipient_address"
                                                                               class="form-control validation"
                                                                               id="recipient-address"
                                                                               placeholder="ჩაბარების მისამართი დეტალურად">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="flex flex-col mt-2">
                                                                <label for="comment" class="form-label">დამატებითი
                                                                    შენიშვნა</label>
                                                                <input value="{{$item->customer_comment}}" type="text"
                                                                       name="comment" class="form-control" id="comment"
                                                                       placeholder="თქვენთვის სასურველი კომენტარი">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div style="border-bottom: rgb(255 255 255 / 0.1) solid 1px"
                                                         class="flex justify-center mt-3 pb-3">
                                                        <button id="sum" style="margin-right:1rem;margin-bottom: 0"
                                                                type="button"
                                                                class="ti-btn ti-btn-outline-light ti-btn-wave"
                                                                disabled>ღირებულება
                                                        </button>
                                                        <input type="hidden" class="form-control validation"
                                                               name="sum_value2" id="total_price2"
                                                               @foreach($sectors as $sector)
                                                                   @if($sector->id===$item->sector_id)
                                                                       @foreach($sector->prices as $price)
                                                                           @if($sector->id===$price->sector_id)
                                                                               value="{{$price->price}}"
                                                               @endif
                                                               @endforeach
                                                               @endif
                                                               @endforeach
                                                               style="width:80px;border:1px solid white;padding-right: 6px;padding-left: 6px;text-align: center">

                                                    </div>
                                                    <div class="ti-modal-footer">
                                                        <button type="button"
                                                                class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                                data-hs-overlay="#staticBackdrop2{{$index}}">
                                                            გაუქმება
                                                        </button>
                                                        <button type="submit"
                                                                class="ti-btn bg-primary text-white !font-medium">
                                                            რედაქტირება
                                                        </button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection  