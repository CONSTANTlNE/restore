@extends('main-layout')
@php
    //    dd($couriers);

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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $index => $order)
                            <tr style="text-align: center">
                                <td style="min-width: 90px!important; white-space:normal">{{$order->created_at}}</td>
                                <td>{{$order->order}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->user->mobile1}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection