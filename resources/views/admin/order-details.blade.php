@extends('main-layout')
@php
    //    dd($couriers);

@endphp
@section('admin-orders')

    <div class="flex justify-center mt-3">
        @if($status === 0)
        <form action="{{route('confirm_order')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$id}}">
            <button style="color:red;background: black" type="submit"
                    class="ti-btn ti-btn-light ti-btn-wave"
            >
               შეკვეთის დადასტურება
            </button>
        </form>
        @else
            <button style="color:green;background: black" type="submit"
                    class="ti-btn ti-btn-light ti-btn-wave"
            >
                დადასტურებული შეკვეთა
            </button>
        @endif
    </div>

    <div class="grid grid-cols-12 gap-6 mt-3">
        @if(session('error_item'))

            <div class="alert alert-danger flex justify-center  col-span-12 " role="alert">
                {{session('error_item')}}
            </div>
        @endif
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">შეკვეთის დეტალები</h5>
                </div>
                <div class="box-body space-y-3">
                    <table id="TableToExport" data-datatable class="display nowrap" style="width:100%;">
                        <thead>
                        <tr>
                            <th class="th-center">თარიღი</th>
                            <th class="th-center">შეკვეთის No</th>
                            <th class="th-center">კომპანიის დასახელება</th>
                            <th class="th-center">დამკვეთის საკონტაქტო</th>
                            <th class="th-center">აღწერა</th>
                            <th class="th-center">წონა</th>
                            <th class="th-center">მოცულობა</th>
                            <th class="th-center">ამანათის ღირებულება</th>
                            <th class="th-center">მიმღები</th>
                            <th class="th-center">მიმღების საკონტაქტო</th>
                            <th class="th-center">მისამართი</th>
                            <th class="th-center">სექტორი</th>
                            <th class="th-center">მიტანის ღირებულება</th>
                            <th class="th-center">ჩაბარდა</th>
                            <th class="th-center">კურიერი</th>
                            <th class="th-center">კურიერის კომენტარი</th>
                            <th class="th-center">მოქმედება</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index => $item)
                            <tr style="text-align: center">
                                <td style="min-width: 90px!important; white-space:normal">{{$item->order->created_at}}</td>
                                <td>{{$item->order->order}}</td>
                                <td>{{$item->order->user->name}}</td>
                                <td>{{$item->order->user->mobile1}}</td>
                                <td style="min-width: 250px!important; white-space:normal">{{$item->description}}</td>
                                <td>{{$item->weight}}</td>
                                <td>
                                    <p>სიგრძე: {{$item->length}}</p>
                                    <p>სიგანე: {{$item->width}}</p>
                                    <p>სიმაღლე: {{$item->height}}</p>
                                </td>
                                <td>{{$item->item_value}}</td>
                                <td>{{$item->receiver}}</td>
                                <td>{{$item->receiver_phone}}</td>
                                <td style="min-width: 250px!important; white-space:normal">{{$item->receiver_address}}</td>
                                <td>
                                    @foreach($sectors as $sector)
                                        @if($sector->id===$item->sector_id)
                                            {{$sector->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
{{--                                    @foreach($sectors as $sector)--}}
{{--                                        @if($sector->id===$item->sector_id)--}}
{{--                                            @foreach($sector->prices as $price)--}}
{{--                                                @if($sector->id===$price->sector_id)--}}
{{--                                                    {{$price->price}}--}}
{{--                                                @endif--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}
{{--                                    @endforeach--}}
                                    {{$item->delivery_price}}
                                </td>
                                <td>
                                    @if($item->status == 1)
                                        <span style="color: green" class="material-symbols-outlined">done</span>
                                    @else
                                        <span style="color: red" class="material-symbols-outlined">close</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:void(0);" class="hs-dropdown-toggle ti-btn ti-btn-primary-full "
                                       data-hs-overlay="#staticBackdrop{{$index}}">
                                        @if($item->driver_id===null)
                                            არჩევა
                                        @else
                                            შეცვლა
                                        @endif
                                    </a>
                                    @foreach ($couriers as $courier)
                                        @if ($courier->id === $item->driver_id)
                                            <p style="color:gold">{{$courier->name}}</p>
                                            @break;
                                        @endif
                                    @endforeach
                                    <div id="staticBackdrop{{$index}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <div class="ti-modal-content">
                                                <form action="{{route('assign_driver')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="package" value="{{$item->id}}">
                                                    <div class="ti-modal-header">
                                                        <h6 class="modal-title text-[1rem] font-semibold">კურიერის
                                                            არჩევა</h6>
                                                        <button type="button"
                                                                class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                                data-hs-overlay="#staticBackdrop{{$index}}">
                                                        </button>
                                                    </div>
                                                    <div class="col-span-12  md:col-span-6 xl:!col-span-3">
                                                        <div class="box">
                                                            <div class="box-body">
                                                                <select name="courier"
                                                                        class="ti-form-select rounded-sm !p-0 t courier-tomselect"
                                                                        id="select-beast{{$index}}" autocomplete="off">
                                                                    <option value="">არჩევა</option>
                                                                    @foreach($couriers as $courier)
                                                                        <option value="{{$courier->id}}">{{$courier->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ti-modal-footer">
                                                        <button type="button"
                                                                class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                                data-hs-overlay="#staticBackdrop{{$index}}">
                                                            დახურვა
                                                        </button>
                                                        <button type="submit"
                                                                class="ti-btn bg-primary text-white !font-medium">არჩევა
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                                <td>{{$item->driver_comment}}</td>
                                <td>
{{--                                    მხოლოდ ადმინს უნდა ქონდეს ამის უფლება--}}
{{--                                    მომხმარებელმა უნდა დამიდასტუროს წაშლა--}}
                                    {{--წაშლა--}}
                                    @role('admin')
                                    <a href="javascript:void(0);"
                                       class="hs-dropdown-toggle ti-btn border-primary"
                                       data-hs-overlay="#delete{{$index}}">
                                        <span style="color:red" class="material-symbols-outlined">delete</span>
                                    </a>
                                    <div id="delete{{$index}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <form id="deleteForm{{$index}}" method="post"
                                                  action="{{route('admin-items-delete')}}">
                                                @csrf
                                                <input style="display: none" value="{{$item->id}}" name="id">
                                                <input style="display: none" name="order_id" value="{{$item->order_id}}">

                                                <div class="ti-modal-content">
                                                    <div class="ti-modal-header orerHeader ">

                                                        <button style="display: none" type="button"
                                                                class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                                data-hs-overlay="#delete{{$index}}">
                                                            <span class="sr-only">Close</span>
                                                            <i class="ri-close-line"></i>
                                                        </button>
                                                    </div>
                                                    <div class="box">
                                                        <div class="box-body"
                                                             style="padding-left:0!important;padding-right: 0!important">
                                                            <div class="flex justify-center order-header">

                                                                    <div class="flex flex-col">
                                                                        <h6 style="text-align: center"
                                                                            class=" modal-title text-[1rem] font-semibold">
                                                                            დარწმუნებული ხართ?
                                                                        </h6>
                                                                        <br>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="ti-modal-footer">
                                                        <button type="button"
                                                                class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                                data-hs-overlay="#delete{{$index}}">
                                                            გაუქმება
                                                        </button>

                                                            <button class="ti-btn bg-primary text-white !font-medium">
                                                                წაშლა
                                                            </button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @endrole

                                    {{--რედაქტირება--}}
                                    <a  href="javascript:void(0);"
                                       class="hs-dropdown-toggle ti-btn border-primary"
                                       data-hs-overlay="#staticBackdrop2{{$index}}">
                                        <span style="color:blue" class="material-symbols-outlined">edit</span>
                                    </a>
                                    <div  id="staticBackdrop2{{$index}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <form action="{{route('admin-items-edit')}}" method="post">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection