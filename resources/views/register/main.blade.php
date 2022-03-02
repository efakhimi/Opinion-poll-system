@extends('../layout/' . $layout)

@section('head')
    <title>ثبت نام</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Register Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
                    <span class="text-white text-lg ml-3">
                        سامانه نظرسنجی
                    </span>
                </a>
                <div class="my-auto">
                    <img alt="Rubick Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">چند کلیک ساده مانده تا <br> حساب کاربری خودتان را بسازید.</div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">تمام پرسشنامه های خود را یکجا مدیریت کنید</div>
                </div>
            </div>
            <!-- END: Register Info -->
            <!-- BEGIN: Register Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">ثبت نام</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <form method="post" action="{{url('register')}}">
            @csrf
                    <div class="intro-x mt-2 text-slate-400 dark:text-slate-400 xl:hidden text-center">چند کلیک ساده مانده تا حساب کاربری خودتان را بسازید.. تمام پرسشنامه های خود را یکجا مدیریت کنید</div>
                    <div class="intro-x mt-8">
                        <input name="first_name" :value="{{ old('first_name') }}" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="نام شما">
                        <input name="email" :value="{{ old('email') }}" type="email" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="ایمیل">
                        <input name="password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="رمز عبور">
                        <input name="password_confirmation" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="تایید رمز عبور">
                    </div>
                    <div class="intro-x flex items-center text-slate-600 dark:text-slate-500 mt-4 text-xs sm:text-sm">
                        <input name="tos" id="agree" type="checkbox" class="form-check-input border mr-2">
                        <a class="text-primary dark:text-slate-200 ml-1" href="{{url('tos')}}">قوانین</a>
                        <label class="cursor-pointer select-none" for="agree"> را می پذیرم</label>.
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" id="btn-register" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">ثبت نام</button>
                        <button class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top" onClick="window.location.href='{{url("login")}}'">ورود</button>
                    </div>
            </form>
                </div>
            </div>
            <!-- END: Register Form -->
        </div>
    </div>
@endsection