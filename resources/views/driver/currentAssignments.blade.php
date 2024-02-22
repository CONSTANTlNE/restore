@extends('main-layout')


@section('driver-index')

    <div class="grid grid-cols-12 gap-6 mt-3">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">ჩასაბარებელი ამანათები</h5>
                </div>
                <div class="box-body space-y-3">
                    <table id="TableToExport" data-datatable class="display nowrap" style="width:100%;">
                        <thead>
                        <tr>
                            <th class="th-center">თარიღი</th>
                            <th class="th-center">შეკვეთის No</th>
                            <th class="th-center">დამკვეთის საკონტაქტო</th>
                            <th class="th-center">მისამართი</th>
                            <th class="th-center">მიმღების საკონტაქტო</th>
                            <th class="th-center">აღწერა</th>
                            <th class="th-center">წონა</th>
                            <th class="th-center">მოცულობა</th>
                            <th class="th-center">მიმღები</th>


                            <th class="th-center">სექტორი</th>
                            <th class="th-center">ჩაბარდა</th>
                            <th class="th-center">კურიერის კომენტარი</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $index => $item)
                            <tr style="text-align: center">
                                <td style="min-width: 90px!important; white-space:normal">{{$item->order->created_at}}</td>
                                <td>{{$item->order->order}}</td>
                                <td>{{$item->order->user->mobile1}}</td>
                                <td>
                                    <div style="display: flex;align-items: center">
                                        <input style="min-width: 250px!important; white-space:normal;"
                                               class="form-control" disabled id="address"
                                               value="{{$item->receiver_address}}">
                                        <label style="margin-left: 1rem" for="address" class onclick="myFunction()">
                                            <span style="font-size: 2rem;"
                                                  class="material-symbols-outlined copy-button">content_copy</span>
                                        </label>
                                    </div>
                                </td>
                                <td class="address">{{$item->receiver_phone}}</td>
                                <td style="min-width: 250px!important; white-space:normal">{{$item->description}}</td>
                                <td>{{$item->weight}}</td>
                                <td>
                                    <p>სიგრძე: {{$item->length}}</p>
                                    <p>სიგანე: {{$item->width}}</p>
                                    <p>სიმაღლე: {{$item->height}}</p>
                                </td>
                                <td>{{$item->receiver}}</td>


                                <td>
                                    @foreach($sectors as $sector)
                                        @if($sector->id===$item->sector_id)
                                            {{$sector->name}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if($item->status===0)
                                        <form action="{{route('item-finish')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <button style="color:red;background: black" type="submit"
                                                    class="ti-btn ti-btn-light ti-btn-wave"
                                            >
                                                ჩაბარება
                                            </button>
                                        </form>
                                    @endif
                                </td>

                                <td style="
                                max-width: 250px!important;
                                white-space:normal;
                                 ">
                                    <a href="javascript:void(0);" class="hs-dropdown-toggle ti-btn ti-btn-primary-full "
                                       data-hs-overlay="#commentModal">
                                        @if($item->driver_comment===null)
                                            კომენტარი
                                        @else
                                            შევლა
                                        @endif
                                    </a>
                                    <div id="commentModal"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <form action="{{route('makeComment')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <div class="ti-modal-content">
                                                    <div class="ti-modal-header">
                                                    </div>
                                                    <div class="ti-modal-body px-4">
                                                        <textarea class="w-full form-control" name="driver_comment"
                                                                  placeholder="კომენტარი"></textarea>
                                                    </div>
                                                    <div class="ti-modal-footer">
                                                        <button type="button"
                                                                class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                                data-hs-overlay="#commentModal">
                                                            გაუქმება
                                                        </button>
                                                        <button class="ti-btn bg-primary text-white !font-medium">
                                                            კომენტარი
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <p>{{$item->driver_comment}}</p>
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