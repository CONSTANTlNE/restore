@extends('main-layout')
@php
    //    dd($couriers);

@endphp
@section('admin-orders')

    <div class="grid grid-cols-12 gap-6 mt-3">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">ამანათები</h5>
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
                            <th class="th-center">სტატუსი</th>
                            <th class="th-center">კურიერი</th>
                            <th class="th-center">კურიერის კომენტარი</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index => $item)
                            <tr style="text-align: center">
                                <td style="min-width: 90px!important; white-space:normal">{{$item->order->created_at}}</td>
                                <td>{{$item->order->order}}</td>
                                <td>{{$item->order->user->name}}</td>
                                <td>{{$item->order->user->mobile1}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->weight}}</td>
                                <td>
                                    <p>სიგრძე: {{$item->length}}</p>
                                    <p>სიგანე: {{$item->width}}</p>
                                    <p>სიმაღლე: {{$item->height}}</p>
                                </td>
                                <td>{{$item->item_value}}</td>
                                <td>{{$item->receiver}}</td>
                                <td>{{$item->receiver_phone}}</td>
                                <td>{{$item->receiver_address}}</td>
                                <td>სექტორი</td>
                                <td>მიტანის ღირებულება</td>
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
                                <td>კურიერის კომენტარი</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection