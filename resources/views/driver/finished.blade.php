@extends('main-layout')


@section('driver-finished')

    <div class="grid grid-cols-12 gap-6 mt-3">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">ჩაბარებული ამანათები</h5>
                </div>
                <div class="box-body space-y-3">
                    <table id="TableToExport" data-datatable class="display nowrap" style="width:100%;">
                        <thead>
                        <tr>
                            <th class="th-center">შეკვეთის თარიღი</th>
                            <th class="th-center">ჩაბარების თარიღი</th>
                            <th class="th-center">შეკვეთის No</th>
                            <th class="th-center">დამკვეთის საკონტაქტო</th>
                            <th class="th-center">აღწერა</th>
                            <th class="th-center">წონა</th>
                            <th class="th-center">მოცულობა</th>
                            <th class="th-center">მიმღები</th>
                            <th class="th-center">მიმღების საკონტაქტო</th>
                            <th class="th-center">მისამართი</th>
                            <th class="th-center">სექტორი</th>

                            <th class="th-center">კურიერის კომენტარი</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index => $item)
                            <tr style="text-align: center">
                                <td style="min-width: 90px!important; white-space:normal">{{$item->order->created_at}}</td>
                                <td  style="min-width: 90px!important; white-space:normal">
                                    {{$item->delivered_at}}
                                </td>
                                <td>{{$item->order->order}}</td>
                                <td>{{$item->order->user->mobile1}}</td>
                                <td style="min-width: 250px!important; white-space:normal">{{$item->description}}</td>
                                <td>{{$item->weight}}</td>
                                <td>
                                    <p>სიგრძე: {{$item->length}}</p>
                                    <p>სიგანე: {{$item->width}}</p>
                                    <p>სიმაღლე: {{$item->height}}</p>
                                </td>
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
                                    {{$item->driver_comment}}
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