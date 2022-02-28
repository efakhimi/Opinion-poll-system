@extends('../layout/' . $layout)

@section('head')
    <title>{{$surveyData['title']}}</title>
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
                    @if($surveyData['photo']=='')
                        <img class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/illustration.svg') }}">
                    @else
                        <img class="-intro-x w-1/2 -mt-16" src="{{ asset('images/survey/'  . $surveyData['photo']) }}">
                    @endif
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">{{$surveyData['title']}}</div>
                    <div class="-intro-x mx-5 mt-5 text-white text-opacity-70 dark:text-slate-400">{!!$surveyData['description']!!}</div>
                </div>
            </div>
            <!-- END: Survey Info -->
            <!-- BEGIN: Survey Form -->
            
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-right">سوالات</h2>

                    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('survey/'.$surveyData['url'])}}">
                    @csrf
                    <div id="answers-accordion" class="accordion accordion-boxed mt-5">
                        @foreach($questions as $qk=>$question)
                        <div class="accordion-item w-full">
                            <div id="answers-accordion-content-{{($qk)}}" class="accordion-header">
                                <button class="accordion-button" type="button" data-tw-toggle="collapse" data-tw-target="#answers-accordion-collapse-{{($qk)}}" aria-expanded="true" aria-controls="answers-accordion-collapse-{{($qk)}}">
                                    سوال {{($qk+1)}}: {{$question['question']}}
                                </button>
                            </div>
                            <div id="answers-accordion-collapse-{{($qk)}}" class="accordion-collapse collapse show" aria-labelledby="answers-accordion-content-{{($qk+1)}}" data-tw-parent="#answers-accordion">
                                <div class="accordion-body text-slate-600 dark:text-slate-500 leading-relaxed">
                                    @foreach(json_decode($question['answers']) as $ak=>$answer)
                                    <div class="form-check mt-2">
                                        <input id="answer-{{($ak)}}" class="form-check-input" type="radio" name="answers[{{$question['id']}}]" value="{{$ak}}">
                                        <label class="form-check-label" for="answer-{{($ak)}}">{{$answer}}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                                    
                                
                                    
                                
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">ثبت پاسخ ها</button>
                    </div>
                    </form>
                    
                </div>
            </div>
            <!-- END: Survey Form -->
        </div>
    </div>
@endsection
