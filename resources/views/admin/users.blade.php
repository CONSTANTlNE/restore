@extends('main-layout')


@section('admin-users')
    <div class="block justify-center page-header md:flex" style="padding-top: 0;padding-bottom: 0">
        <div>
            {{--                    New Order Modal--}}
            <div class="box-body flex justify-center">
                <a href="javascript:void(0);" style="background: black!important"
                   class="hs-dropdown-toggle ti-btn border-primary" data-hs-overlay="#staticBackdrop">მომხმარებლის
                    დამატება
                </a>
                <div id="staticBackdrop" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                    <div style="max-width: 30rem!important"
                         class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                        <form id="userForm" method="post" action="{{route('newUser')}}">
                            @csrf
                            <div class="ti-modal-content">
                                <div class="ti-modal-header orerHeader ">
                                    <div class="flex justify-center order-header">
                                        <div class="flex justify-center orderQty">
                                            <h6 style="text-align: center;margin-top: 1rem"
                                                class="ggggg2 modal-title text-[1rem] font-semibold">
                                                ახალი მომხმარებლის დამატება</h6>
                                        </div>
                                    </div>
                                    <button style="display: none" type="button"
                                            class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                            data-hs-overlay="#staticBackdrop">
                                        <span class="sr-only">Close</span>
                                        <i class="ri-close-line"></i>
                                    </button>
                                </div>

                                <div class="box">
                                    <div class="box-body">
                                        <div class=" flex flex-col  gap-5">
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">სახელი</label>
                                                <input id="name" name="name" type="text" class="validation my-auto ti-form-input  rounded-sm"
                                                       >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">მეილი</label>
                                                <input name="email" type="text" class="validation my-auto ti-form-input  rounded-sm"
                                                       >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">პაროლი</label>
                                                <input name="password" type="text" class="validation my-auto ti-form-input  rounded-sm"
                                                      >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">საიდენტიფიკაციო / პირადი ნომერი</label>
                                                <input name="id_number" type="text" class="validation my-auto ti-form-input  rounded-sm"
                                                       >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">იურიდიული ფორმა</label>
                                                <select name="legal_form" class="validation ti-form-select rounded-sm !py-2 !px-3">
                                                    <option >არჩევა</option>
                                                    <option value="ფ/პ">ფ/პ</option>
                                                    <option value="ი/მ">ი/მ</option>
                                                    <option value="შპს">შპს</option>
                                                </select>
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">კომპანიის დასახელება</label>
                                                <input name="company_name" type="text" class=" my-auto ti-form-input  rounded-sm "
                                                      >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">ტელ 1</label>
                                                <input name="tel-1" type="text" class="validation my-auto ti-form-input  rounded-sm "
                                                       >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">ტელ 2</label>
                                                <input name="tel-2" type="text" class=" my-auto ti-form-input  rounded-sm "
                                                       >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">როლი</label>
                                                <select name="role" class="validation ti-form-select rounded-sm !py-2 !px-3">
                                                    <option >არჩევა</option>
                                                    @foreach($roles as $role)
                                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="ti-modal-footer">
                                    <button type="button"
                                            class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                            data-hs-overlay="#staticBackdrop">
                                        დახურვა
                                    </button>
                                    <button class="ti-btn bg-primary text-white !font-medium">
                                        დამატება
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">მომხმარებლები</h5>
                </div>
                <div class="box-body space-y-3">
                    <table id="TableToExport" data-datatable class="display nowrap" style="width:100%;">
                        <thead >
                        <tr>
                            <th class="th-center">სახელი</th>
                            <th class="th-center">მეილი</th>
                            <th class="th-center">საკონტაქტო 1</th>
                            <th class="th-center">საკონტაქტო 2</th>
                            <th class="th-center">იურიდიული ფორმა</th>
                            <th class="th-center">საიდენტიფიკაციო</th>
                            <th class="th-center">კომპანიის დასახელება</th>
                            <th class="th-center">ტიპი</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr style="text-align: center">
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->mobile1}}</td>
                            <td>{{$user->mobile2}}</td>
                            <td>{{$user->legal_form}}</td>
                            <td>{{$user->ident_no}}</td>
                            <td>{{$user->company_name}}</td>
                            @foreach($user->getRoleNames() as $role) @endforeach
                            <td>{{$role}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection