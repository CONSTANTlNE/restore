@extends('auth.auth-layout')

@section('login')
  <div class="flex justify-center authentication authentication-basic items-center h-full text-defaultsize text-defaulttextcolor">
    <div class="grid grid-cols-12">
      <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-3 sm:col-span-2"></div>
      <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-6 sm:col-span-8 col-span-12">
{{--        <div class="my-[2.5rem] flex justify-center">--}}
{{--          <a href="index.html">--}}
{{--            <img src="../assets/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">--}}
{{--            <img src="../assets/images/brand-logos/desktop-dark.png" alt="logo" class="desktop-dark">--}}
{{--          </a>--}}
{{--        </div>--}}
        <div class="box">
          <form action="{{ route('login') }}" method="POST">
            @csrf
          <div class="box-body !p-[3rem]">
            <p class="h5 font-semibold mb-2 text-center">ავტორიზაცია</p>
{{--            <p class="mb-4 text-[#8c9097] dark:text-white/50 opacity-[0.7] font-normal text-center">Welcome back Jhon !</p>--}}
            <div class="grid grid-cols-12 gap-y-4">
              <div class="xl:col-span-12 col-span-12">
                <label for="signin-username" class="form-label text-default">მეილი</label>
                <input type="text" name="email" class="form-control form-control-lg w-full !rounded-md" id="signin-username" >
              </div>
              <div class="xl:col-span-12 col-span-12 mb-2">
                <label for="signin-password" class="form-label text-default block">პაროლი<a href="{{route('password.request')}}" class="ltr:float-right rtl:float-left text-danger">პაროლის აღდგენა</a></label>
                <div class="input-group">
                  <input type="password" name="password" class="form-control form-control-lg !rounded-s-md" id="signin-password">
                  <button  aria-label="button" class="ti-btn ti-btn-light !rounded-s-none !mb-0" type="button" onclick="createpassword('signin-password',this)" id="button-addon2"><i class="ri-eye-off-line align-middle"></i></button>
                </div>
                <div class="mt-2">
{{--                  <div class="form-check !ps-0">--}}
{{--                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">--}}
{{--                    <label class="form-check-label text-[#8c9097] dark:text-white/50 font-normal" for="defaultCheck1">--}}
{{--                      Remember password ?--}}
{{--                    </label>--}}
{{--                  </div>--}}
                </div>
              </div>
              <div class="xl:col-span-12 col-span-12 grid mt-2">
                <button  class="ti-btn ti-btn-primary !bg-primary !text-white !font-medium">შესვლა</button>
              </div>
            </div>
            <div class="text-center">
              <p class="text-[1rem] text-[#8c9097] dark:text-white/50 mt-4">არ გაქვთ ნაგარიში? <a href="{{ route('register') }}" class="text-primary">რეგისტრაცია</a></p>
            </div>
{{--            <div class="text-center my-4 authentication-barrier">--}}
{{--              <span>OR</span>--}}
{{--            </div>--}}
{{--            <div class="btn-list text-center">--}}
{{--              <button aria-label="button" type="button" class="ti-btn ti-btn-icon ti-btn-light me-[0.365rem]">--}}
{{--                <i class="ri-facebook-line font-bold text-dark opacity-[0.7]"></i>--}}
{{--              </button>--}}
{{--              <button aria-label="button" type="button" class="ti-btn ti-btn-icon ti-btn-light me-[0.365rem]">--}}
{{--                <i class="ri-google-line font-bold text-dark opacity-[0.7]"></i>--}}
{{--              </button>--}}
{{--              <button aria-label="button" type="button" class="ti-btn ti-btn-icon ti-btn-light">--}}
{{--                <i class="ri-twitter-line font-bold text-dark opacity-[0.7]"></i>--}}
{{--              </button>--}}
{{--            </div>--}}
          </div>
          </form>
        </div>
      </div>
      <div class="xxl:col-span-4 xl:col-span-4 lg:col-span-4 md:col-span-3 sm:col-span-2"></div>
    </div>
  </div>
@endsection