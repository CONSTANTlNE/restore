@extends('main-layout')
@php
//            dd($balance);

@endphp
@section('admin-orders')

    <div class="grid grid-cols-12 gap-6 mt-3">
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
                            <th class="th-center">კომპანიის დასახელება</th>
                            <th class="th-center">დამკვეთის საკონტაქტო</th>
                            <th class="th-center">ღირებულება</th>
                            <th class="th-center">სტატუსი</th>
                            <th class="th-center">მოქმედება</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $index => $order)
                            <tr style="text-align: center">
                                <td style="width: 90px!important; white-space:normal">{{$order->created_at}}</td>
                                <td>{{$order->order}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->user->mobile1}}</td>
                                <td>{{$order->sum_value}}</td>
                                <td>
                                    @if($order->status===0)
                                        <form action="{{route('confirm_order')}}" method="post">
                                            @csrf
                                            <input style="display: none" name="id" value="{{$order->id}}">
                                            <button style="color:red;background: black"
                                                    @foreach($balance as $amount)
                                                        @if($amount->customer_id == $order->user->id  && $amount->total_amount < $order->sum_value)
{{--                                                            @php dd( $amount->total_amount) @endphp--}}
                                                            type="button"
                                                    @else type="submit"
                                                    @endif
                                                    @endforeach
                                                    class="ti-btn ti-btn-light ti-btn-wave">
                                                დადასტურება
                                            </button>
                                        </form>
                                    @else
                                        <button style="color:green;background: black" type="submit"
                                                class="ti-btn ti-btn-light ti-btn-wave"
                                        >
                                            დადასტურებული
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin_order_details',['order'=>$order->id])}}">
                                        <span style="color:gold" class="material-symbols-outlined">visibility</span>
                                    </a>
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
                                                  action="{{route('admin-order-delete')}}">
                                                @csrf
                                                <input style="display: none" name="id" value="{{$order->id}}">

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
                                                                    <p style="color: red">შეკვეთაში არსებული ყველა
                                                                        ამანათი წაიშლება</p>
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