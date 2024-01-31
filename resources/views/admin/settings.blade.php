@extends('main-layout')
@php
//dd($sectors->prices);
 @endphp
@section('admin-settings')

    <div class="grid grid-cols-12 gap-6 mt-3">
        <div class="xl:col-span-6 col-span-12">
            <div class="box">
                <div class="box-header justify-between">
                    <div class="box-title">
                        სექტორის დამატება
                    </div>
                </div>
                <div class="box-body">
                    <form action="{{route('addSector')}}" method="post">
                        @csrf
                        <div class="grid grid-cols-12 gap-4 mb-4 ">
                            <div class="sm:col-span-3 col-span-12">
                                <label for="sector-name" class="form-label !text-[.875rem] text-black">სექტორი</label>
                                <input type="text" name="sector_name" class="form-control" id="sector-name"
                                       placeholder="">
                            </div>
                            <div class="sm:col-span-2 col-span-12">
                                <label for="sector_price" class="form-label !text-[.875rem] text-black">ფასი</label>
                                <input type="text" id="sector_price" name="sector_price" class="form-control"
                                       placeholder="" aria-label="">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="sector-address" class="form-label text-[.875rem] text-black">დასახელება</label>
                            <input type="text" name="sector_address" class="form-control" id="sector-address"
                                   placeholder="">
                        </div>

                        <button class="ti-btn ti-btn-primary-full" type="submit">დამატება</button>
                    </form>
                </div>

            </div>
        </div>
        <div class="xl:col-span-6 col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">სექტორი</h5>
                </div>
                <div class="box-body space-y-3">
                    <table id="TableToExport" data-datatable class="display nowrap" style="width:100%;">
                        <thead>
                        <tr>
                            <th class="th-center">სექტორი</th>
                            <th class="th-center">დასახელება</th>
                            <th class="th-center">ფასი</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sectors as $index => $sector)
                            <tr style="text-align: center">
                                <td>{{$sector->name}}</td>
                                <td>{{$sector->address}}</td>
                                @foreach($sector->prices as $price)
                                    <td>{{$price->price}}</td>
                                @endforeach

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>

@endsection