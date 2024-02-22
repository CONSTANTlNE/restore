@extends('main-layout')
@php
    //        dd($balance);
@endphp
@section('admin-balance')

    @role('admin')
    <div class="block justify-center page-header md:flex" style="padding-top: 0;padding-bottom: 0">
        <div>
            <div class="box-body flex justify-center m">
                <a style="color:red;background: black" href="javascript:void(0);"
                   class="hs-dropdown-toggle ti-btn ti-btn-primary-full " data-hs-overlay="#staticBackdrop">
                    გადახდა
                </a>
                <div id="staticBackdrop" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                    <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                        <div class="ti-modal-content">
                            <div class="ti-modal-header">
                                <h6 class="modal-title text-[1rem] font-semibold">გადახდის დამატება</h6>
                                <button type="button"
                                        class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                        data-hs-overlay="#staticBackdrop">
                                    <span class="sr-only">Close</span>
                                    <i class="ri-close-line"></i>
                                </button>
                            </div>
                            <form method="post" action="{{route('make-payment')}}">
                                @csrf
                                <div class="ti-modal-body px-4 grid grid-cols-12 gap-4 mt-0">

                                    <div class="md:col-span-12 col-span-12">
                                        <label for="payment_select" class="form-label !text-[.875rem] text-black">კლიენტი</label>
                                        <select name="customer" class="ti-form-select rounded-sm !p-0"
                                                id="payment_select"
                                                autocomplete="off">
                                            <option value="">აირჩიეთ კლიენტი</option>
                                            @foreach($customers as $index =>$customer)
                                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="md:col-span-4 col-span-12">
                                        <label for="bank" class="form-label !text-[.875rem] text-black">ბანკი</label>
                                        <select style="padding-top: 8px!important;padding-bottom: 8px!important"
                                                name="bank" class="ti-form-select rounded-sm p-1" autocomplete="off"
                                                id="bank">
                                            <option value="BOG">BOG</option>
                                            <option value="TBC">TBC</option>
                                        </select>
                                    </div>
                                    <div class="md:col-span-4 col-span-12">
                                        <label for="date" class="form-label !text-[.875rem] text-black">თარიღი</label>
                                        <input name="date" type="date" class="form-control" id="date"
                                               placeholder="Choose date">
                                    </div>
                                    <div class="md:col-span-2 col-span-12">
                                        <label for="amount" class="form-label !text-[.875rem] text-black">თანხა</label>
                                        <input type="text" name="amount" id="amount" class="ti-form-input rounded-sm">
                                    </div>


                                </div>
                                <div class="ti-modal-footer">
                                    <button type="button"
                                            class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                            data-hs-overlay="#staticBackdrop
              ">
                                        გაუქმება
                                    </button>
                                    <button class="ti-btn bg-primary text-white !font-medium">გადახდა</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   @endrole

    <div class="grid grid-cols-12 gap-6 mt-3">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">ბალანსი</h5>
                </div>
                <div class="box-body space-y-3">
                    <table id="TableToExport" data-datatable class="display nowrap" style="width:100%;">
                        <thead>
                        <tr>
                            <th class="th-center">კლიენტი</th>
                            <th class="th-center">კომპანია</th>
                            <th class="th-center">ბალანსი</th>
                            <th class="th-center">დეტალურად</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($balance!==[])
                            @foreach($customers as $index => $customer)
                                <tr style="text-align: center">
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->company_name}}</td>
                                    @if ($balance[0]->customer_id === $customer->id)
                                        <td style="
                                        @if($balance[0]->total_amount < 0)
                                         color:red
                                         @else
                                         color:green
                                        @endif
                                        "> {{ $balance[0]->total_amount }}</td>
                                    @else
                                        <td>0</td>
                                    @endif
                                    <td>
                                        <a href="{{route('balance_details',['customer'=>$customer->id])}}"
                                           target="_blank">
                                            <span style="color:gold" class="material-symbols-outlined">visibility</span>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection