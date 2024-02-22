@extends('auth.auth-layout')

@section('register')

    <form action="{{route('register')}}" method="post">
        @csrf
        <div class="flex justify-center authentication authentication-basic items-center h-full text-defaultsize text-defaulttextcolor">
            <div class="grid grid-cols-12">
                <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-3 sm:col-span-2"></div>
                <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-6 sm:col-span-8 col-span-12">
                    {{--                    <div class="my-[2.5rem] flex justify-center">--}}
                    {{--                        <a href="index.html">--}}
                    {{--                            <img src="../assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">--}}
                    {{--                            <img src="../assets/images/brand-logos/desktop-dark.png" alt="logo" class="desktop-dark">--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                    <div class="box">
                        <div class="box-body !p-[3rem]">
                            <p class="h5 font-semibold mb-2 text-center">რეგისტრაცია</p>
                            <p class="mb-4 text-[#8c9097] dark:text-white/50 opacity-[0.7] font-normal text-center">
                                გთხოვთ შეავსოთ ყველა მოცემული ველი</p>
                            <div class="grid grid-cols-12 gap-y-4">
                                <div class="xl:col-span-12 col-span-12">
                                    <label for="signup-firstname" class="form-label text-default">სახელი</label>
                                    <input type="text" class="form-control form-control-lg w-full !rounded-md"
                                           id="signup-firstname" name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <p style="color:red" class="mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="xl:col-span-12 col-span-12">
                                    <label for="signup-firstname" class="form-label text-default">საიდენტიფიკაციო /
                                        პირადი ნომერი</label>
                                    <input type="text" class="form-control form-control-lg w-full !rounded-md"
                                           id="signup-firstname" name="id_number" value="{{ old('id_number') }}">
                                    @error('id_number')
                                    <p style="color:red" class="mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="xl:col-span-12 col-span-12">
                                    <label class="ti-form-label text-default">იურიდიული
                                        ფორმა</label>
                                    <select name="legal_form"
                                            class="validation ti-form-select rounded-sm !py-2 !px-3">
                                        <option></option>
                                        <option value="ფ/პ" {{ old('legal_form') === 'ფ/პ' ? 'selected' : '' }}>ფ/პ</option>
                                        <option value="ი/მ" {{ old('legal_form') === 'ი/მ' ? 'selected' : '' }}>ი/მ</option>
                                        <option value="შპს" {{ old('legal_form') === 'შპს' ? 'selected' : '' }}>შპს</option>
                                    </select>
                                    @error('legal_form')
                                    <p style="color:red" class="mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="xl:col-span-12 col-span-12">
                                    <label class="ti-form-label text-default">კომპანიის
                                        დასახელება</label>
                                    <input name="company_name" type="text" value="{{ old('company_name') }}"
                                           class=" my-auto ti-form-input  rounded-sm ">
                                    @error('company_name')
                                    <p style="color:red" class="mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="xl:col-span-12 col-span-12">
                                    <label class="ti-form-label dark:text-defaulttextcolor/70 mb-0">მობილური</label>
                                    <input name="tel-1" type="text" value="{{ old('tel-1') }}"
                                           class="validation my-auto ti-form-input  rounded-sm ">
                                    @error('tel-1')
                                    <p style="color:red" class="mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="xl:col-span-12 col-span-12">
                                    <label for="signup-lastname" class="form-label text-default">მეილი</label>
                                    <input type="text" class="form-control form-control-lg w-full !rounded-md"
                                           id="signup-lastname" name="email" value="{{ old('email') }}">
                                    @error('email')
                                    <p style="color:red" class="mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="xl:col-span-12 col-span-12">
                                    <label for="signup-password" class="form-label text-default">პაროლი</label>
                                    <div class="input-group">
                                        <input type="password"
                                               class="form-control form-control-lg !rounded-e-none"
                                               id="signup-password" name="password" value="{{ old('password') }}">

                                        <button aria-label="button" type="button"
                                                class="ti-btn ti-btn-light !rounded-s-none !mb-0"
                                                onclick="createpassword('signup-password',this)"
                                                id="button-addon2"><i class="ri-eye-off-line align-middle"></i></button>

                                    </div>
                                    @error('password')
                                    <p style="color:red" class="mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="xl:col-span-12 col-span-12 mb-2">
                                    <label for="signup-confirmpassword" class="form-label text-default">
                                        გაიმეორეთ პაროლი</label>
                                    <div class="input-group">
                                        <input type="password"
                                               class="form-control form-control-lg !rounded-e-none"
                                               id="signup-confirmpassword" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                        <button aria-label="button" type="button"
                                                class="ti-btn ti-btn-light !rounded-s-none !mb-0"
                                                onclick="createpassword('signup-confirmpassword',this)"
                                                id="button-addon21"><i class="ri-eye-off-line align-middle"></i>
                                        </button>

                                    </div>
                                    <div class="mt-4">
                                        <div class="form-check !flex !ps-0">
                                            <input class="form-check-input me-1" type="checkbox" value="1"
                                                   id="defaultCheck1" name="terms" {{ old('terms') ? 'checked' : '' }}>
                                            <label class="ps-2 form-check-label text-[#8c9097] dark:text-white/50 font-normal block"
                                                   for="defaultCheck1">
                                                ვეთანხმები <a href="javascript:void(0);"
                                                              class="text-success" data-hs-overlay="#staticBackdrop"><u>წესებსა და პირობებს</u></a>
                                            </label>
                                            {{-- წესები და პირობები--}}
                                            <div id="staticBackdrop" class="hs-overlay hidden ti-modal  [--overlay-backdrop:static]">
                                                <div class="hs-overlay-open:mt-7 ti-modal-box mt-0 ease-out">
                                                    <div class="ti-modal-content">
                                                        <div class="ti-modal-header">
                                                            <h6 class="modal-title text-[1rem] font-semibold">წესები და პირობები</h6>
                                                            <button type="button" class="hs-dropdown-toggle !text-[1rem] !font-semibold !text-defaulttextcolor" data-hs-overlay="#staticBackdrop">
                                                                <span class="sr-only">Close</span>
                                                                <i class="ri-close-line"></i>
                                                            </button>
                                                        </div>
                                                        <div class="ti-modal-body px-4">
                                                            <p>
                                                     წესი ერთი
                                                            </p>
                                                        </div>
                                                        <div class="ti-modal-footer">
                                                            <button type="button"
                                                                    class="hs-dropdown-toggle ti-btn  ti-btn-secondary-full align-middle"
                                                                    data-hs-overlay="#staticBackdrop">
                                                                დახურვა
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @error('terms')
                                        <p style="color:red" class="mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="xl:col-span-12 col-span-12 grid mt-2">
                                    <button
                                            class="ti-btn ti-btn-lg bg-primary text-white !font-medium dark:border-defaultborder/10">
                                        რეგისტრაცია
                                    </button>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-[1rem] text-[#8c9097] dark:text-white/50 mt-4">გაქვთ ანგარიში? <a
                                            href="{{route('login')}}" class="text-primary">შესვლა</a></p>
                            </div>
                            {{--                            <div class="text-center my-4 authentication-barrier">--}}
                            {{--                                <span>OR</span>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="btn-list text-center">--}}
                            {{--                                <button aria-label="button" type="button" class="ti-btn ti-btn-icon ti-btn-light me-[0.365rem]">--}}
                            {{--                                    <i class="ri-facebook-line font-bold text-dark opacity-[0.7]"></i>--}}
                            {{--                                </button>--}}
                            {{--                                <button aria-label="button" type="button" class="ti-btn ti-btn-icon ti-btn-light me-[0.365rem]">--}}
                            {{--                                    <i class="ri-google-line font-bold text-dark opacity-[0.7]"></i>--}}
                            {{--                                </button>--}}
                            {{--                                <button aria-label="button" type="button" class="ti-btn ti-btn-icon ti-btn-light">--}}
                            {{--                                    <i class="ri-twitter-line font-bold text-dark opacity-[0.7]"></i>--}}
                            {{--                                </button>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-3 sm:col-span-2"></div>
            </div>
        </div>
    </form>
@endsection