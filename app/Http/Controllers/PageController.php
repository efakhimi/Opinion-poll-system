<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\Survey;

class PageController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if(Auth::user()->is_admin!=1)
            redirect('/surveys-list');   
        $surveysCount = Survey::all()->count();
        $activeSurveysCount = Survey::where('active', 1)->count();
        $activeSurveysPercent = $activeSurveysCount== 0 ? 0 : round($activeSurveysCount*100/$surveysCount , 2);
        
        $usersCount = Users::all()->count();
        $activeUsersCount = Users::where('active', 1)->count();
        $activeUsersPercent = $activeUsersCount== 0 ? 0 : round($activeUsersCount*100/$usersCount , 2);

        $latestSurveys = Survey::orderBy('id', 'desc')->get()->take(5);
        return view('survey/dashboard', [
            'surveysCount' => $surveysCount,
            'activeSurveysCount' => $activeSurveysCount,
            'activeSurveysPercent' => $activeSurveysPercent,
            'usersCount' => $usersCount,
            'activeUsersCount' => $activeUsersCount,
            'activeUsersPercent' => $activeUsersPercent,
            'latestSurveys' => $latestSurveys,
        ]);
    }
}
