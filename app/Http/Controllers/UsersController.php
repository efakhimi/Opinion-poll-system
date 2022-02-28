<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Survey;
use App\Models\Questions;
use App\Models\Answers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newUserForm()
    {
        if(Auth::user()->is_admin!=1)
            return redirect('/');

        return view('survey/new-user', [
        ]);
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newUser(Request $request)
    { 
        if(Auth::user()->is_admin!=1)
            return redirect('/');

        $validated = $request->validate([
            'name' => 'required|string|unique:users,name|max:70|min:3',
            'email' => 'required|email:rfc,dns|unique:users,email|max:70|min:10',
            'password' => 'required|string|min:8',
            'gender' => 'required|string|in:male,female',
            // 'active' => 'accepted',
            // 'isSupporter' => 'accepted',
            // 'isAdmin' => 'accepted',
        ]);
        

        $user = new Users;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->gender = $request->gender;
        $user->is_admin = $request->isAdmin == "on" ? 1 : 0;
        $user->is_admin = $request->isSupporter == "on" ? 2 : $user->is_admin;
        $user->active = $request->active=="on" ? 1:0;

        $user->save();

        return redirect('users-list')->with('status', 'کاربر جدید با موفقیت ایجاد شد.');
    
    }
    
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function usersList()
    {
        if(Auth::user()->is_admin!=1)
            return redirect('/');
            
        $users = Users::paginate(10);
        //dd($users);
        return view('survey/users-list', [
            'users' => $users
        ]);
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Interger $id
     * @return \Illuminate\Http\Response
     */
    public function editUserForm(Request $request, $id=null)
    {
        if(Auth::user()->is_admin!=1)
            return redirect('/');
            
        if($id == null)
            return redirect('users-list')->with('statusErr', 'برای ویرایش باید یک کاربر انتخاب کرده باشید.');

        $userData = Users::where('id', $id)->first();
        //dd($userData);
        if($userData == null)
            return redirect('users-list')->with('statusErr', 'کاربر مورد نظر یافت نشد.');
        return view('survey/edit-user', [
            'userData' => $userData
        ]);
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editUser(Request $request, $id=null)
    {
        if(Auth::user()->is_admin!=1)
            return redirect('/');
            
        if($id == null)
            return redirect('users-list')->with('statusErr', 'برای ویرایش باید یک کاربر انتخاب کرده باشید.');

        $userData = Users::where('id', $id)->first();
        //dd($userData);
        if($userData == null)
            return redirect('users-list')->with('statusErr', 'کاربر مورد نظر یافت نشد.');

        $validated = $request->validate([
            'name' => 'required|string|unique:users,name,'.$id.'|max:70|min:3',
            'email' => 'required|email:rfc,dns|unique:users,email,'.$id.'|max:70|min:10',
            // 'password' => 'string|min:8',
            'gender' => 'required|string|in:male,female',
            // 'active' => 'accepted',
            // 'isSupporter' => 'accepted',
            // 'isAdmin' => 'accepted',
        ]);
        $is_admin = $request->isAdmin == "on" ? 1 : 0;
        $is_admin = $request->isSupporter == "on" ? 2 : $is_admin;
        $active = $request->active=="on" ? 1:0;
 
        Users::where('id',$id)->update(['name'=>$request->name, 'email'=>$request->email, 'gender'=>$request->gender, 'is_admin'=>$is_admin, 'active'=>$active]);
        if($request->password != null && trim($request->password)!="")
            Users::where('id',$id)->update(['password'=>Hash::make($request->password)]);


        return redirect('users-list')->with('status', 'ویرایش با موفقیت انجام شد.');
    
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Interger $id
     * @return \Illuminate\Http\Response
     */
    public function delUser(Request $request, $id=null)
    {
        if(Auth::user()->is_admin!=1)
            return redirect('/');
            
        if($id == null)
            return redirect('users-list')->with('statusErr', 'برای ویرایش باید یک کاربر انتخاب کرده باشید.');

        $userData = Users::where('id', $id)->first();
        //dd($userData);
        if($userData == null)
            return redirect('users-list')->with('statusErr', 'کاربر مورد نظر یافت نشد.');
        
        Users::where('id', $id)->delete();
        return redirect('users-list')->with('status', 'کاربر مورد نظر با موفقیت حذف شد.');
    }

    

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newSurveyForm()
    {
        if(Auth::user()->access_level>=2)
            return redirect('/user-plans');
            
            
        return view('survey/new-survey', [
        ]);
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newSurvey(Request $request)
    { 
        if(Auth::user()->access_level>=2)
            return redirect('/user-plans');

        $validated = $request->validate([
            'title' => 'required|string|max:70|min:3',
            'desc' => 'required|string|min:10',
            'type' => 'required|string|in:0,1,2',
            'pic' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'active' => 'accepted',
            // 'isSupporter' => 'accepted',
            // 'isAdmin' => 'accepted',
        ]);

        $survey = new Survey;
        $survey->uid = Auth::user()->id;
        $survey->title = $request->title;
        $survey->description = $request->desc;
        $survey->type = $request->type;
        $survey->active = $request->active=="on" ? 1:0;
        $survey->public = $request->public=="on" ? 1:0;
        $survey->registered_only = $request->registered=="on" ? 1:0;
        
        if(!isset($request->public) || $request->public!="on")
            $survey->password = rand(11,99)."".rand(33,88)."".rand(11,99);
        
        $survey->url = substr(md5(time().":".rand(11111,9999999).":".$request->title),0,10);
        if(isset($request->pic) AND $request->pic!=null)
        {
            $imageName = time()."_".$survey->url.'.'.$request->pic->extension();  
         
            $request->pic->move(public_path('images/survey/'), $imageName);

            $survey->photo = $imageName;
        }
        else
            $survey->photo = '';

        $survey->save();

        return redirect('finilize-survey/'.$survey->id)->with('status', 'پرسشنامه جدید با موفقیت ایجاد شد.');
    
    }
    
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function surveysList ()
    {
        if(Auth::user()->access_level>=2)
            return redirect('/user-plans');
            
        $surveys = Survey::where("uid", Auth::user()->id)->paginate(10);

        $questions_count = array();
        foreach ($surveys as $survey)
            $questions_count[$survey['id']] = Questions::where("sid", $survey['id'])->count();

            
        return view('survey/surveys-list', [
            'surveys' => $surveys,
            'sCount' => $questions_count
        ]);
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Interger $id
     * @return \Illuminate\Http\Response
     */
    public function finilizeSurveyForm(Request $request, $id=null)
    {
        if(Auth::user()->access_level>=2)
            return redirect('/user-plans');
            
        if($id == null)
            return redirect('surveys-list')->with('statusErr', 'برای افزودن سوال باید یک پرسشنامه انتخاب کرده باشید.');

        $surveyData = Survey::where('id', $id)->first();
        //dd($userData);
        if($surveyData == null)
            return redirect('users-list')->with('statusErr', 'پرسشنامه مورد نظر یافت نشد.');
        if($surveyData['uid'] != Auth::user()->id)
            return redirect('surveys-list')->with('statusErr', 'پرسشنامه مورد نظر متعلق به شما نیست.');
        return view('survey/finilize-survey', [
            'surveyData' => $surveyData
        ]);
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function finilizeSurvey(Request $request, $id=null)
    {
        if(Auth::user()->access_level>=2)
            return redirect('/user-plans');
            
        if($id == null)
            return redirect('surveys-list')->with('statusErr', 'برای ویرایش باید یک پرسشنامه انتخاب کرده باشید.');

        $surveyData = Survey::where('id', $id)->first();
        //dd($userData);
        if($surveyData == null)
            return redirect('surveys-list')->with('statusErr', 'پرسشنامه مورد نظر یافت نشد.');
        if($surveyData['uid'] != Auth::user()->id)
            return redirect('surveys-list')->with('statusErr', 'پرسشنامه مورد نظر متعلق به شما نیست.');

        
        $validated = $request->validate([
            "question"    => "required|array|min:1",
            "question.*"  => "required|string|distinct|min:5",
            "answer"    => "required|array|min:1",
            "answer.*"    => "required|array|min:2",
            "answer.*.*"  => "required|string|distinct|min:1",
            "correct"    => "sometimes|nullable|array|min:1",
            "correct.*"    => "sometimes|nullable|integer|min:0",
        ]);

        //dd($request->correct);

        foreach($request->question as $qk=>$qusetion)
        {
            $Questions = new Questions;
            $Questions->sid = $id;
            $Questions->question = $qusetion;
            $Questions->photo = "";
            $Questions->answers = json_encode($request->answer[$qk]);
            if($surveyData['type']==1)
            {
                $Questions->correct =$request->correct[$qk];
            }
            else
                $Questions->correct = -1;
            $Questions->save();
        }

        return redirect('survey-detail')->with('status', 'سوالات با موفقیت افزوده شدند.');
    
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Interger $id
     * @return \Illuminate\Http\Response
     */
    public function surveyDetail(Request $request, $id=null)
    {
        if(Auth::user()->access_level>=2)
            return redirect('/user-plans');
            
        if($id == null)
            return redirect('surveys-list')->with('statusErr', 'برای افزودن سوال باید یک پرسشنامه انتخاب کرده باشید.');

        $surveyData = Survey::where('id', $id)->first();
        //dd($userData);
        if($surveyData == null)
            return redirect('users-list')->with('statusErr', 'پرسشنامه مورد نظر یافت نشد.');
        
        if($surveyData['uid'] != Auth::user()->id)
            return redirect('surveys-list')->with('statusErr', 'پرسشنامه مورد نظر متعلق به شما نیست.');

        $qCount = Questions::where("sid", $surveyData['id'])->count();
        $questions = Questions::where("sid", $surveyData['id'])->get();
        $answers = array();
        /**
         * for question 1 we will have:
         * $answers[1][0]['count'] = 5 => for answer 0 of q1 we have 5 votes
         * $answers[1][0]['title'] = 'Answer 1'
         * $answers[1][1]['count'] = 9 => for answer 1 of q1 we have 9 votes
         * $answers[1][1]['title'] = 'Answer 2'
         */
        foreach($questions as $q){
            $ans = json_decode($q['answers']);
            foreach($ans as $ak=>$an)
            {
                $whereClause = [
                    'sid'=>$surveyData['id'],
                    'qid'=>$q['id'],
                    'answer'=>$ak
                ];
                $answers[$q['id']][$ak]['count'] = Answers::where($whereClause)->count();
                $answers[$q['id']][$ak]['title'] = $an;
            }
        }

        $answerLabels = [];
        $answerData = [];
        foreach($answers as $ak=>$ans)
        {
            $answerLabels[$ak] = [];
            $answerData[$ak] = [];
            foreach($ans as $k=>$a){
                $answerLabels[$ak][$k] = $a['title'];
                $answerData[$ak][$k] = $a['count'];
            }
        }   
        
        return view('survey/survey-detail', [
            'surveyData' => $surveyData,
            'qCount' => $qCount,
            'answerLabels' => $answerLabels,
            'answerData' => $answerData,
            'answers' => $answers,
            'questions' => $questions
        ]);
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Interger $id
     * @return \Illuminate\Http\Response
     */
    public function answerSurveyForm(Request $request, $id=null)
    {
        if($id == null)
            return redirect('/');

        $surveyData = Survey::where('url', $id)->first();
        if($surveyData == null)
            return redirect('/');
        if($surveyData['active'] != 1)
            return redirect('/');
        if($surveyData['registered_only'] == 1 AND Auth::user()== null)
            return redirect('/');

        $qCount = Questions::where("sid", $surveyData['id'])->count();
        $questions = Questions::where("sid", $surveyData['id'])->get();
        return view('survey/survey', [
            'layout' => 'login',
            'surveyData' => $surveyData,
            'questions' => $questions,
            'qCount' => $qCount
        ]);
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Interger $id
     * @return \Illuminate\Http\Response
     */
    public function answerSurvey(Request $request, $id=null)
    {
        if($id == null)
            return redirect('/');

        $surveyData = Survey::where('url', $id)->first();
        if($surveyData == null)
            return redirect('/');
        if($surveyData['active'] != 1)
            return redirect('/');
        if($surveyData['registered_only'] == 1 AND Auth::user()== null)
            return redirect('/');


        
        $validated = $request->validate([
            "answers"    => "required|array|min:1",
            "answers.*"  => "required|integer|min:0",
        ]);
    
    
        foreach($request->answers as $qk=>$ans)
        {
            $answer = new Answers;
            $answer->sid = $surveyData['id'];
            $answer->qid = $qk;
            $answer->answer = $ans;
            
            if(Auth::user()== null)
            {
                $answer->uid =0;
            }
            else
                $answer->uid = Auth::user()->id;
            $answer->save();
        }
    
        return redirect('thank-you');
    }

    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Interger $id
     * @return \Illuminate\Http\Response
     */
    public function thankYou()
    {
        return view('survey/thank-you', [
            'layout' => 'login',
        ]);
    }

}
