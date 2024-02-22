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
                            <th class="th-center">ახალი ფასი</th>
                            <th class="th-center">განახლება</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sectors as $index => $sector)
                            <tr style="text-align: center">
                                <td>{{$sector->name}}</td>
                                <td>{{$sector->address}}</td>
                                <td>{{$sector->prices->sortByDesc('created_at')->first()->price}}</td>
                                <td>
                                    <a href="javascript:void(0);" class="hs-dropdown-toggle ti-btn ti-btn-primary-full "
                                       data-hs-overlay="#commentModal{{$index}}">
                                        ახალი ფასი
                                    </a>
                                    <div id="commentModal{{$index}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <form action="{{route('newPrice')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="sector" value="{{$sector->id}}">
                                                <div class="ti-modal-content">
                                                    <div class="ti-modal-header">
                                                    </div>
                                                    <div class="ti-modal-body px-4">
                                                        <input class="w-full form-control" name="price">
                                                    </div>
                                                    <div class="ti-modal-footer">
                                                        <button type="button"
                                                                class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                                data-hs-overlay="#commentModal{{$index}}">
                                                            გაუქმება
                                                        </button>
                                                        <button class="ti-btn bg-primary text-white !font-medium">
                                                            განახლება
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                   {{--  განახლება--}}
                                    <a href="javascript:void(0);"
                                       class="hs-dropdown-toggle ti-btn border-primary"
                                       data-hs-overlay="#commentModal2{{$index}}">
                                        <span style="color:blue" class="material-symbols-outlined">edit</span>
                                    </a>
                                    <div id="commentModal2{{$index}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <form action="{{route('sectorUpdate')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$sector->id}}">
                                                <div class="ti-modal-content">
                                                    <div class="ti-modal-header">
                                                        <p>სექტორის განახლება</p>
                                                    </div>
                                                    <div class="ti-modal-body px-4">

                                                        <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                                                            <label for="sector-name"
                                                                   class="mb-3 text-muted">სექტორი</label>
                                                            <br>
                                                            <input
                                                                    value="{{$sector->name}}"
                                                                    type="text" name="sector_name"
                                                                   class="form-control" id="sector-name"
                                                                   placeholder="">
                                                        </div>

                                                        <br>
                                                        <br>
                                                        <div class="xl:col-span-4 lg:col-span-6 md:col-span-6 sm:col-span-12 col-span-12">
                                                            <label for="sector-address"
                                                                   class="mb-3 text-muted">დასახელება</label>
                                                            <br>
                                                            <input
                                                                    value="{{$sector->address}}"
                                                                    type="text" name="sector_address"
                                                                   class="form-control" id="sector-address"
                                                                   placeholder="">
                                                        </div>
                                                    </div>

                                                    <div class="ti-modal-footer">
                                                        <button type="button"
                                                                class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                                data-hs-overlay="#commentModal2{{$index}}">
                                                            გაუქმება
                                                        </button>
                                                        <button class="ti-btn bg-primary text-white !font-medium">
                                                            განახლება
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