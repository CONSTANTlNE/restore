@extends('main-layout')
@php
    //            dd($transactions);
@endphp
@section('admin-balance-detailed')

    <div class="grid grid-cols-12 gap-6 mt-3">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">ბალანსი - ყველა ტრანზაქცია</h5>
                </div>
                <div class="box-body space-y-3">
                    <table id="TableToExport" data-datatable class="display nowrap" style="width:100%;">
                        <thead>
                        <tr>
                            <th class="th-center">კლიენტი</th>
                            <th class="th-center">კომპანია</th>
                            <th class="th-center">გადახდის თარიღი</th>
                            <th class="th-center">გადახდილი / გადასახდელი</th>
                            <th class="th-center">შეკვეთის თარიღი</th>
                            <th class="th-center">შეკვეთის თანხა</th>
                            <th class="th-center">შეკვეთის ნომერი</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $index =>$transaction)
                        <tr style="text-align: center">

                                @php
                                    //                                           dd($transaction->orders());
                                @endphp
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->company_name}}</td>
                                <td>{{$transaction->transfer_date}}</td>
                                <td>{{$transaction->amount}}</td>
                                @if($transaction->orders===null)
                                    <td>0</td>
                                @else
                                    <td>{{$transaction->orders->created_at}}</td>
                                @endif
                                @if($transaction->orders===null)
                                    <td>0</td>
                                @else
                                <td>{{$transaction->orders->sum_value}}</td>
                                @endif
                                @if($transaction->orders===null)
                                    <td>0</td>
                                @else
                                <td>{{$transaction->orders->order}}</td>
                                @endif


                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection