@extends('../layout/' . $layout)

@section('subhead')
    <title>مرحله پایانی پرسشنامه</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium ml-auto">طرح سوالات پرسشنامه</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <!-- BEGIN: Form Layout -->
            
        <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('finilize-survey/'.$surveyData['id'])}}">
        @csrf
            <div class="intro-y box p-5" id="survey">
                
                <div id='q0'>
                    <div class="mb-5">
                        <label for="survey-form-0" class="form-label">سوال 1</label>
                        <input id="survey-form-0" type="text" class="form-control w-full" placeholder="صورت سوال" name="question[0]">
                    </div>
                    <div class="mb-5">
                        <label class="form-label">پاسخ ها</label>
                    </div>
                    <div class="mb-5">
                        @if($surveyData['type']==1)
                            <input id="correct-a0-0" class="form-check-input" type="radio" name="correct[0][0]"><label class="form-check-label" for="correct-a0-0">این پاسخ صحیح است</label>
                        @endif
                        <input type="text" class="form-control mt-5" placeholder="پاسخ اول" name="answer[0][]">
                    </div>
                    <div class="mb-5">
                        @if($surveyData['type']==1)
                            <input id="correct-a0-1" class="form-check-input" type="radio" name="correct[0][1]"><label class="form-check-label" for="correct-a0-1">این پاسخ صحیح است</label>
                        @endif
                        <input type="text" class="form-control mt-5" placeholder="پاسخ دوم" name="answer[0][]">
                    </div>
                    <div>
                        <button type="button" class="btn btn-lg btn-outline-primary w-full mr-1 mb-2 " onClick="addMoreAnswers(0);"><i data-feather="plus-circle" class="w-5 h-5"></i>&nbsp;&nbsp;پاسخ دیگر</button>
                    </div>
                </div>
                
                @if($surveyData['type']!=2)
                <div>
                    <button type="button" class="btn btn-lg btn-outline-success w-full mr-1 mb-2 " onClick="addMoreQuestions();"><i data-feather="plus-circle" class="w-5 h-5"></i>&nbsp;&nbsp;افزودن سوال</button>
                </div>
                @endif
                
                <div class="text-right mt-5">
                    <button type="button" class="btn btn-outline-secondary w-24 mr-1">لغو</button>
                    <button type="submit" class="btn btn-primary w-24">ذخیره</button>
                </div>
            </div>
        </form>
            <!-- END: Form Layout -->
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
    <script >
        var index = 1;
        var answers = [];
        answers[0]=2;
        const type = {{$surveyData['type']}};
        function addMoreAnswers(qIndex){
            
            const newNode = document.createElement("div");
            newNode.className ="mb-5";
            if(type===1)
            {
                //<input id="correct-a0-0" class="form-check-input" type="radio" name="correct[0][]">
                //<label class="form-check-label" for="correct-a1-1">این پاسخ صحیح است</label>

                const radioCheckNode = document.createElement("INPUT");
                radioCheckNode.setAttribute("type", "radio");
                radioCheckNode.setAttribute("name", "correct["+qIndex+"]["+answers[qIndex]+"]");
                radioCheckNode.setAttribute("id", "correct-a"+qIndex+"-"+answers[qIndex]);
                radioCheckNode.className ="form-check-input";
                newNode.appendChild(radioCheckNode);

                const newLabel = document.createElement("Label");
                newLabel.setAttribute("for","correct-a"+qIndex+"-"+answers[qIndex]);
                newLabel.innerHTML = "این پاسخ صحیح است";
                newLabel.className ="form-check-label";
                newNode.appendChild(newLabel);

            }

            //<input type="text" class="form-control " placeholder="پاسخ اول" name="answer[0][]">
            const inputNode = document.createElement("INPUT");
            inputNode.setAttribute("type", "text");
            inputNode.setAttribute("placeholder", "پاسخ دیگر");
            inputNode.setAttribute("name", "answer["+qIndex+"][]");
            inputNode.className ="form-control mt-5";
            newNode.appendChild(inputNode);
            
            var list = document.getElementById('q'+qIndex);
            list.insertBefore(newNode, list.children[answers[qIndex]+2]);
            answers[qIndex]++;
        }

        function addMoreQuestions()
        {
            if(type===2)
                return;
            const newNode = document.createElement("div");
            newNode.setAttribute("id", "q"+ index);
            //var html = "<div id='test' class='mb-5'>ssssss</div>";
            
            var html = '<div class="mb-5">'+
            '   <label for="survey-form-'+index+'" class="form-label">سوال '+(index+1)+'</label>'+
            '   <input id="survey-form-'+index+'" type="text" class="form-control w-full" placeholder="صورت سوال" name="question['+index+']">'+
            '</div>'+
            '<div class="mb-5">'+
            '    <label class="form-label">پاسخ ها</label>'+
            '</div>'+
            '<div class="mb-5">';
            if(type == 1)
                html += '<input id="correct-a'+index+'-0" class="form-check-input" type="radio" name="correct['+index+'][0]">'+
                '    <label class="form-check-label" for="correct-a'+index+'-0">این پاسخ صحیح است</label>';
            html += '<input type="text" class="form-control mt-5" placeholder="پاسخ اول" name="answer['+index+'][]">'+
            '</div>'+
            '<div class="mb-5">';

            if(type == 1)
                html += '<input id="correct-a'+index+'-1" class="form-check-input" type="radio" name="correct['+index+'][1]">'+
            '    <label class="form-check-label" for="correct-a'+index+'-1">این پاسخ صحیح است</label>';
            html += ''+
            '    <input type="text" class="form-control mt-5" placeholder="پاسخ دوم" name="answer['+index+'][]">'+
            '</div>'+
            '<div>'+
            '    <button type="button" class="btn btn-lg btn-outline-primary w-full mr-1 mb-2 " onClick="addMoreAnswers('+index+');"><i data-feather="plus-circle" class="w-5 h-5"></i>&nbsp;&nbsp;پاسخ دیگر</button>'+
            '</div>';
            newNode.innerHTML = html;

            var list = document.getElementById('survey');
            list.insertBefore(newNode, list.children[index]);
            answers[index] = 2;
            index++;
        }
    </script>
@endsection
