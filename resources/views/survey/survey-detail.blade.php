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

        <div class="col-span-6 sm:col-span-12 xl:col-span-6 intro-y mb-2">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base ml-auto">{{$surveyData['title']}}</h2>
                </div>
                <div class="p-5">
                    @if($surveyData['photo']!='')
                        <div class="h-40 2xl:h-56 image-fit">
                            <img class="rounded-md" src="{{url('images/survey/'  . $surveyData['photo'])}}">
                        </div>
                    @endif
                    <div class="text-slate-600 dark:text-slate-500 mt-5 px-5">{!!$surveyData['description']!!}</div>
                </div>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-12 xl:col-span-6 intro-y mb-2">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base ml-auto">جزئیات</h2>
                </div>
                <div class="font-medium p-5">
                    عنوان : {{$surveyData['title']}}<br>
                    عمومی یا خصوصی؟ : {{$surveyData['public']==1 ? "عمومی" : "خصوصی"}}<br>
                    @if($surveyData['public']==0)
                    کلمه عبور نظرسنجی : {{$surveyData['password']}}<br>
                    @endif
                    فقط ثبت نام شده؟ : {{$surveyData['registered_only'] == 1 ? "فقط ثبت نام شده ها" : "همه"}}<br>
                    وضعیت : {{$surveyData['active']==1 ? "فعال" : "غیر فعال"}}<br>
                    لینک نظرسنجی : 
                    @if($qCount>0)
                    <input type="text" class="form-control mt-2" value="{{url("survey/".$surveyData['url'])}}"  onClick="this.setSelectionRange(0, this.value.length)"><br>
                    @else
                    <a class="btn btn-success w-32 mr-2 mb-2" href="{{url("finilize-survey/".$surveyData['id'])}}"><i data-feather="check-square" class="w-4 h-4 mr-2"></i> افزودن سوال</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-12 xl:col-span-6 intro-y mb-2">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base ml-auto">گزارش شرکت کنندگان</h2>
                </div>
                <div class="font-medium p-5">

                    <canvas id="vertical-bar-chart-widget" height="200"></canvas>

                </div>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-12 xl:col-span-6 intro-y mb-2">
            <div class="intro-y box">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base ml-auto">آمار پاسخ ها</h2>
                </div>
                <div class="font-medium p-5">
                    <canvas id="chart1" height="200"></canvas>
                </div>
                <div class="font-medium p-5">
                    <canvas id="chart2" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('script')
    <script >
const ctx = document.getElementById('chart1').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
    </script>
@endsection