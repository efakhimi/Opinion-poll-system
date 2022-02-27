@extends('../layout/' . $layout)

@section('head')
    <title>از شما سپاسگزاریم</title>
@endsection

@section('content')
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Survey Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{ asset('dist/images/logo.svg') }}">
                    <span class="text-white text-lg ml-3">
                        سامانه نظرسنجی
                    </span>
                </a>
                <div class="my-auto">
                        <img class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/illustration.svg') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">از شما سپاسگزاریم</div>
                    <div class="-intro-x mx-5 mt-5 text-white text-opacity-70 dark:text-slate-400">بابت وقتی که برای پاسخ گویی صرف کردید از شما سپاسگزاریم</div>
                </div>
            </div>
            <!-- END: Survey Info -->
            <!-- BEGIN: Survey Form -->
            
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-right">تشکر</h2>

                    
                </div>
            </div>
            <!-- END: Survey Form -->
        </div>
    </div>
@endsection
