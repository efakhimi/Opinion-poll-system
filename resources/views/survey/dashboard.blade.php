@extends('../layout/' . $layout)

@section('subhead')
    <title>سامانه نظرسنجی | داشبورد</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: General Report -->
                <div class="col-span-12 mt-8">
                    <div class="intro-y flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">گزارشات کلی</h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="users" class="report-box__icon text-pending"></i>
                                        <div class="mr-auto">
                                            <div class="report-box__indicator bg-{{$activeUsersPercent >= 50 ? "success" : "danger"}} tooltip cursor-pointer" title="{{$activeUsersPercent}}% کاربران فعال هستند">
                                            {{$activeUsersPercent}}% <i data-feather="chevron-{{$activeUsersPercent >= 50 ? "up" : "down"}}" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{$usersCount}}</div>
                                    <div class="text-base text-slate-500 mt-1">تعداد کل کاربران</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="file-text" class="report-box__icon text-primary"></i>
                                        <div class="mr-auto">
                                            <div class="report-box__indicator bg-{{$activeSurveysPercent >= 50 ? "success" : "danger"}} tooltip cursor-pointer" title="{{$activeSurveysPercent}}% پرسشنامه ها فعال هستند">
                                                {{$activeSurveysPercent}}% <i data-feather="chevron-{{$activeSurveysPercent >= 50 ? "up" : "down"}}" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{$surveysCount}}</div>
                                    <div class="text-base text-slate-500 mt-1">تعداد کل پرسشنامه ها</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="at-sign" class="report-box__icon text-warning"></i>
                                        <div class="mr-auto">
                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="98.19% تیکت ها پاسخ داده شده اند">
                                                98.19% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">12</div>
                                    <div class="text-base text-slate-500 mt-1">تیکت های پشتیبانی باز</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5">
                                    <div class="flex">
                                        <i data-feather="dollar-sign" class="report-box__icon text-success"></i>
                                        <div class="mr-auto">
                                            <div class="report-box__indicator bg-success tooltip cursor-pointer" title="27% کاربران پلن خریداری کرده اند">
                                                27% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-3xl font-medium leading-8 mt-6">{{number_format(9562000, 2, ".",",")}} تومان</div>
                                    <div class="text-base text-slate-500 mt-1">درآمد تا کنون</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: General Report -->
            </div>
        </div>
        <div class="col-span-12 2xl:col-span-3">
            <div class="2xl:border-l -mb-10 pb-10">
                <div class="2xl:pl-6 grid grid-cols-12 gap-6">
                    <!-- BEGIN: Transactions -->
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3 2xl:mt-8">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">آخرین پرسشنامه ها</h2>
                        </div>
                        <div class="mt-5">
                            @foreach ($latestSurveys as $survey)
                                <div class="intro-x">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                            <img alt="Rubick Tailwind HTML Admin Template" src="{{ ($survey['photo'] == '' ? url('media/no-image-survey.png') : url('images/survey/'  . $survey['photo'])) }}">
                                        </div>
                                        <div class="mr-4 ml-auto">
                                            <div class="font-medium">{{ $survey['title'] }}</div>
                                            <div class="text-slate-500 text-xs mt-0.5">{{ $survey['created_at'] }}</div>
                                        </div>
                                        <div class="{{ $survey['active']==1 ? 'text-success' : 'text-danger' }}">{{ $survey['active']==1 ? 'فعال' : 'غیرفعال' }}</div>
                                    </div>
                                </div>
                            @endforeach
                            <a href="{{url('surveys-list')}}" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500">مشاهده بیشتر</a>
                        </div>
                    </div>
                    <!-- END: Transactions -->
                </div>
            </div>
        </div>
    </div>
@endsection
