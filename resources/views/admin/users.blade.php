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
                                                <input id="name" name="name" type="text"
                                                       class="validation my-auto ti-form-input  rounded-sm"
                                                >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">მეილი</label>
                                                <input name="email" type="text"
                                                       class="validation my-auto ti-form-input  rounded-sm"
                                                >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">პაროლი</label>
                                                <input name="password" type="text"
                                                       class="validation my-auto ti-form-input  rounded-sm"
                                                >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">საიდენტიფიკაციო
                                                    / პირადი ნომერი</label>
                                                <input name="id_number" type="text"
                                                       class="validation my-auto ti-form-input  rounded-sm"
                                                >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">იურიდიული
                                                    ფორმა</label>
                                                <select name="legal_form"
                                                        class="validation ti-form-select rounded-sm !py-2 !px-3">
                                                    <option>არჩევა</option>
                                                    <option value="ფ/პ">ფ/პ</option>
                                                    <option value="ი/მ">ი/მ</option>
                                                    <option value="შპს">შპს</option>
                                                </select>
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">კომპანიის
                                                    დასახელება</label>
                                                <input name="company_name" type="text"
                                                       class=" my-auto ti-form-input  rounded-sm "
                                                >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">ტელ
                                                    1</label>
                                                <input name="tel-1" type="text"
                                                       class="validation my-auto ti-form-input  rounded-sm "
                                                >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">ტელ
                                                    2</label>
                                                <input name="tel-2" type="text"
                                                       class=" my-auto ti-form-input  rounded-sm "
                                                >
                                            </div>
                                            <div class="space-y-2">
                                                <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">როლი</label>
                                                <select name="role"
                                                        class="validation ti-form-select rounded-sm !py-2 !px-3">
                                                    <option>არჩევა</option>
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
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12">
            <div class="box">
                <div class="box-header">
                    <h5 class="box-title">მომხმარებლები</h5>
                </div>
                <div class="box-body space-y-3">
                    <table id="TableToExport" data-datatable class="display nowrap" style="width:100%;">
                        <thead>
                        <tr>
                            <th class="th-center">სახელი</th>
                            <th class="th-center">მეილი</th>
                            <th class="th-center">საკონტაქტო 1</th>
                            <th class="th-center">საკონტაქტო 2</th>
                            <th class="th-center">იურიდიული ფორმა</th>
                            <th class="th-center">საიდენტიფიკაციო</th>
                            <th class="th-center">კომპანიის დასახელება</th>
                            <th class="th-center">ტიპი</th>
                            <th class="th-center">მოქმედება</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $index=> $user)
                            @php
                                //                                dd($user->roles);
                            @endphp
                            <tr style="text-align: center">
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->mobile1}}</td>
                                <td>{{$user->mobile2}}</td>
                                <td>{{$user->legal_form}}</td>
                                <td>{{$user->ident_no}}</td>
                                <td>{{$user->company_name}}</td>
                                @foreach($user->getRoleNames() as $role)

                                @endforeach
                                <td>{{$role}}</td>
                                <td>
                                    {{--წაშლა--}}
                                    @role('admin')
                                    <a href="javascript:void(0);"
                                       class="hs-dropdown-toggle ti-btn border-primary"
                                       data-hs-overlay="#delete{{$index}}">
                                        <span style="color:red" class="material-symbols-outlined">delete</span>
                                    </a>
                                    <div id="delete{{$index}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <form id="deleteForm{{$index}}" method="post"
                                                  action="{{route('user_delete')}}">
                                                @csrf
                                                <input style="display: none" value="{{$user->id}}" name="id">

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
                                    @endrole
                                    {{--რედაქტირება--}}
                                    <a href="javascript:void(0);"
                                       class="hs-dropdown-toggle ti-btn border-primary"
                                       data-hs-overlay="#staticBackdrop2{{$index}}">
                                        <span style="color:blue" class="material-symbols-outlined">edit</span>
                                    </a>
                                    <div id="staticBackdrop2{{$index}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div style="max-width: 30rem!important"
                                             class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <form id="userForm" method="post" action="{{route('updateUser')}}">
                                                @csrf
                                                <input style="display: none" value="{{$user->id}}" name="id">
                                                <div class="ti-modal-content">
                                                    <div class="ti-modal-header orerHeader ">
                                                        <div class="flex justify-center order-header">
                                                            <div class="flex justify-center orderQty">
                                                                <h6 style="text-align: center;margin-top: 1rem"
                                                                    class="ggggg2 modal-title text-[1rem] font-semibold">
                                                                    მომხმარებლის რედაქტირება</h6>
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
                                                                    <input value="{{$user->name}}" id="name" name="name"
                                                                           type="text"
                                                                           class="validation my-auto ti-form-input  rounded-sm"
                                                                    >
                                                                </div>
                                                                <div class="space-y-2">
                                                                    <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">მეილი</label>
                                                                    <input value="{{$user->email}}" name="email"
                                                                           type="text"
                                                                           class="validation my-auto ti-form-input  rounded-sm"
                                                                    >
                                                                </div>

                                                                <div class="space-y-2">
                                                                    <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">საიდენტიფიკაციო
                                                                        / პირადი ნომერი</label>
                                                                    <input value="{{$user->ident_no}}" name="id_number"
                                                                           type="text"
                                                                           class="validation my-auto ti-form-input  rounded-sm"
                                                                    >
                                                                </div>
                                                                <div class="space-y-2">
                                                                    <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">იურიდიული
                                                                        ფორმა</label>
                                                                    <select name="legal_form"
                                                                            class="validation ti-form-select rounded-sm !py-2 !px-3">
                                                                        <option value="{{$user->legal_form}}">{{$user->legal_form}}</option>
                                                                        <option value="ფ/პ">ფ/პ</option>
                                                                        <option value="ი/მ">ი/მ</option>
                                                                        <option value="შპს">შპს</option>
                                                                    </select>
                                                                </div>
                                                                <div class="space-y-2">
                                                                    <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">კომპანიის
                                                                        დასახელება</label>
                                                                    <input value="{{$user->company_name}}"
                                                                           name="company_name" type="text"
                                                                           class=" my-auto ti-form-input  rounded-sm "
                                                                    >
                                                                </div>
                                                                <div class="space-y-2">
                                                                    <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">ტელ
                                                                        1</label>
                                                                    <input value="{{$user->mobile1}}" name="mobile1"
                                                                           type="text"
                                                                           class="validation my-auto ti-form-input  rounded-sm "
                                                                    >
                                                                </div>
                                                                <div class="space-y-2">
                                                                    <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">ტელ
                                                                        2</label>
                                                                    <input value="{{$user->mobile2}}" name="mobile2"
                                                                           type="text"
                                                                           class=" my-auto ti-form-input  rounded-sm "
                                                                    >
                                                                </div>
                                                                <div class="space-y-2">
                                                                    <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">როლი</label>
                                                                    <select name="role"
                                                                            class="validation ti-form-select rounded-sm !py-2 !px-3">
                                                                        <option value="{{$user->roles[0]->name}}">{{$user->roles[0]->name}}</option>
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
                                                                data-hs-overlay="#staticBackdrop2{{$index}}">
                                                            დახურვა
                                                        </button>
                                                        <button class="ti-btn bg-primary text-white !font-medium">
                                                            განახლება
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- პაროლის ცვლილება --}}
                                    <a href="javascript:void(0);"
                                       class="hs-dropdown-toggle ti-btn border-primary"
                                       data-hs-overlay="#staticBackdrop3{{$index}}">
                                        <span style="color:gold" class="material-symbols-outlined">lock_open</span>
                                    </a>
                                    <div id="staticBackdrop3{{$index}}"
                                         class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                        <div style="max-width: 30rem!important"
                                             class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                            <form id="userForm" method="post" action="{{route('updatePassword')}}">
                                                @csrf
                                                <input style="display: none" value="{{$user->id}}" name="id">
                                                <div class="ti-modal-content">
                                                    <div class="ti-modal-header orerHeader ">
                                                        <div class="flex justify-center order-header">
                                                            <div class="flex justify-center orderQty">
                                                                <h6 style="text-align: center;margin-top: 1rem"
                                                                    class="ggggg2 modal-title text-[1rem] font-semibold">
                                                                    პაროლის ცვლილება </h6>
                                                            </div>
                                                        </div>
                                                        <button style="display: none" type="button"
                                                                class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor"
                                                                data-hs-overlay="#staticBackdrop3{{$index}}">
                                                            <span class="sr-only">Close</span>
                                                            <i class="ri-close-line"></i>
                                                        </button>
                                                    </div>

                                                    <div class="box">
                                                        <div class="box-body">
                                                            <div class=" flex flex-col  gap-5">
                                                                <div class="space-y-2">
                                                                    <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">{{$user->name}}</label>
                                                                    <input name="password"
                                                                           type="text"
                                                                           class="validation my-auto ti-form-input  rounded-sm"
                                                                    >
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="ti-modal-footer">
                                                        <button type="button"
                                                                class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                                data-hs-overlay="#staticBackdrop3{{$index}}">
                                                            დახურვა
                                                        </button>
                                                        <button class="ti-btn bg-primary text-white !font-medium">
                                                            განახლება
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- მომხმარებლის გააქტიურება --}}
                                    @if($user->active===0)
                                        <form style="all: unset" action="{{route('activateUser')}}" method="post">
                                            @csrf
                                            <input style="display: none" value="{{$user->id}}" name="id">
                                            <button
                                                    class="hs-dropdown-toggle ti-btn border-primary">
                                                <span style="color:red" class="material-symbols-outlined">done</span>
                                            </button>
                                        </form>
                                    @else
                                        <form style="all: unset" action="{{route('deactivateUser')}}" method="post">
                                            @csrf
                                            <input style="display: none" value="{{$user->id}}" name="id">
                                            <button
                                                    class="hs-dropdown-toggle ti-btn border-primary">
                                                <span style="color:green" class="material-symbols-outlined">done_all</span>
                                            </button>
                                        </form>

                                    @endif
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