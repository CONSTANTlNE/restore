@extends('main-layout')
@php
//            dd($customers);
@endphp
@section('admin-payments')

    <div class="grid grid-cols-12 gap-6 mt-3">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">ჩარიცხვები</h5>
                </div>
                <div class="box-body space-y-3">
                    <table id="TableToExport" data-datatable class="display nowrap" style="width:100%;">
                        <thead>
                        <tr>
                            <th class="th-center">კლიენტი</th>
                            <th class="th-center">კომპანია</th>
                            <th class="th-center">გადახდის თარიღი</th>
                            <th class="th-center">ბანკი</th>
                            <th class="th-center">თანხა</th>
                            <th class="th-center">მოქმედება</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $index =>$transaction)
                            <tr style="text-align: center">

                                @php
                                    //                                           dd($transaction->orders());
                                @endphp
                                @foreach($customers as $customer)
                                @if($customer->id === $transaction->customer_id)
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->company_name}}</td>
                                @endif
                                @endforeach
                                <td>{{$transaction->transfer_date}}</td>
                                <td>{{$transaction->bank}}</td>
                                <td>{{$transaction->amount}}</td>
                                <td>
                                    {{--წაშლა--}}
                                    <a href="javascript:void(0);"
                                       class="hs-dropdown-toggle ti-btn border-primary"
                                       data-hs-overlay="#delete{{$index}}">
                                        <span style="color:red" class="material-symbols-outlined">delete</span>
                                    </a>
                                    <div id="delete{{$index}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <form id="deleteForm{{$index}}" method="post"
                                                  action="{{route('payment_delete')}}">
                                                @csrf
                                                <input style="display: none" value="{{$transaction->id}}" name="id">

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



                                    {{--რედაქტირება--}}
                                    <a href="javascript:void(0);"
                                       class="hs-dropdown-toggle " data-hs-overlay="#staticBackdrop2{{$index}}">
                                        <span style="color:blue" class="material-symbols-outlined">edit</span>
                                    </a>
                                    <div id="staticBackdrop2{{$index}}" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <div class="ti-modal-content">
                                                <div class="ti-modal-header">
                                                    <h6 class="modal-title text-[1rem] font-semibold">გადახდის დამატება</h6>
                                                    <button type="button"
                                                            class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                            data-hs-overlay="#staticBackdrop2{{$index}}">
                                                        <span class="sr-only">Close</span>
                                                        <i class="ri-close-line"></i>
                                                    </button>
                                                </div>
                                                <form method="post" action="{{route('payment_update')}}">
                                                    @csrf
                                                    <div class="ti-modal-body px-4 grid grid-cols-12 gap-4 mt-0">

                                                        <div class="md:col-span-12 col-span-12">
                                                            <label for="payment_select" class="form-label !text-[.875rem] text-black">კლიენტი</label>
                                                            <select name="customer" class="ti-form-select rounded-sm !p-0"
                                                                    id="payment_select"
                                                                    autocomplete="off">
                                                                @if($customer->id === $transaction->customer_id)
                                                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                                @endif
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
                                                                <option value="{{$transaction->bank}}">{{$transaction->bank}}</option>
                                                                <option value="BOG">BOG</option>
                                                                <option value="TBC">TBC</option>
                                                            </select>
                                                        </div>
                                                        <div class="md:col-span-4 col-span-12">
                                                            <label for="date" class="form-label !text-[.875rem] text-black">თარიღი</label>
                                                           <br>
                                                            <input value="{{$transaction->transfer_date}}" name="date" type="date" class="form-control" id="date"
                                                                   placeholder="Choose date">
                                                        </div>
                                                        <div class="md:col-span-2 col-span-12">
                                                            <label for="amount" class="form-label !text-[.875rem] text-black">თანხა</label>
                                                            <input value="{{$transaction->amount}}" type="text" name="amount" id="amount" class="ti-form-input rounded-sm">
                                                        </div>


                                                    </div>
                                                    <div class="ti-modal-footer">
                                                        <button type="button"
                                                                class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                                data-hs-overlay="#staticBackdrop2{{$index}}
              ">
                                                            გაუქმება
                                                        </button>
                                                        <button class="ti-btn bg-primary text-white !font-medium">განახლება</button>
                                                    </div>
                                                </form>
                                            </div>
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