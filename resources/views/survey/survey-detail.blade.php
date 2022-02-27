@extends('../layout/' . $layout)

@section('subhead')
    <title>جزئیات پرسشنامه | {{$surveyData['title']}}</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">جزئیات {{$surveyData['title']}}</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <div class="mx-auto">
                            <i data-feather="layers" class="w-10 h-10"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-bold leading-8 mt-6 mx-auto">{{$qCount}}</div>
                    <div class="text-base text-gray-600 mt-1 mx-auto">تعداد سوالات</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <div class="mx-auto">
                            <i data-feather="user-check" class="w-10 h-10"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-bold leading-8 mt-6 mx-auto">159</div>
                    <div class="text-base text-gray-600 mt-1 mx-auto">تعداد شرکت کنندگان</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <div class="mx-auto">
                            <i data-feather="{{($surveyData['public'] == 0 ? 'lock' : 'unlock')}}" class="w-10 h-10"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-bold leading-8 mt-6 mx-auto">{{($surveyData['public'] == 1 ? "عمومی" : "خصوصی")}}</div>
                    <div class="text-base text-gray-600 mt-1 mx-auto">وضعیت پرسشنامه</div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <div class="report-box zoom-in">
                <div class="box p-5">
                    <div class="flex">
                        <div class="mx-auto">
                            <i data-feather="pen-tool" class="w-10 h-10"></i>
                        </div>
                    </div>
                    <div class="text-3xl font-bold leading-8 mt-6 mx-auto">{{($surveyData['type'] == 0 ? "معمولی چند سوالی" : ($surveyData['type'] == 1 ? "امتحان" : "معمولی تک سوالی"))}}</div>
                    <div class="text-base text-gray-600 mt-1 mx-auto">نوع پرسشنامه</div>
                </div>
            </div>
        </div>

        <div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base ml-auto">{{$surveyData['title']}}</h2>
                </div>
                <div id="icon-dismiss-alert" class="p-5">
                    <div class="preview">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base ml-auto">{{$surveyData['title']}}</h2>
                </div>
                <div id="icon-dismiss-alert" class="p-5">
                    <div class="preview">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

