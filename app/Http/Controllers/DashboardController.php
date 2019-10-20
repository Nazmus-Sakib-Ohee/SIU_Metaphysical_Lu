<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\PasswordRecovery;
use App\Role;
use App\Idea;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getLogout()
    {
        \Auth::logout();
        return redirect('/');
    }

    public function index()
    {
         return redirect('/dashboard/2019');
      
    }

    public function analytics($year)
    {

        $ideaAnalyticsNewIndex=0;
        $ideaAnalyticsInProcessIndex=0;
        $ideaAnalyticsOnHoldIndex=0;
        $ideaAnalyticsCompletedIndex=0;

        $months=['0'=>'01','1'=>'02','2'=>'03','3'=>'04','4'=>'05','5'=>'06','6'=>'07','7'=>'08','8'=>'09','9'=>'10','10'=>'11','11'=>'12'];

         $ideaAnalyticsNew=array();
         $ideaAnalyticsInProcess=array();
         $ideaAnalyticsOnHold=array();
         $ideaAnalyticsCompleted=array();

            foreach ($months as $key => $value) {
        $NewAnalytics=Idea::where('status','New')->
       whereMonth('created_at', '=', $value)
       ->whereYear('created_at', '=', $year)->count();

       $ideaAnalyticsNew[$ideaAnalyticsNewIndex]=[
        'month'=>$value,
        'year'=>$year,
        'amount'=>$NewAnalytics

       ];

        $ideaAnalytics=Idea::where('status','In-Progress')->
       whereMonth('created_at', '=', $value)
       ->whereYear('created_at', '=', $year)->count();

       $ideaAnalyticsInProcess[$ideaAnalyticsInProcessIndex]=[
        'month'=>$value,
        'year'=>$year,
        'amount'=>$ideaAnalytics

       ];

        $ideaAnalyticsOn=Idea::where('status','On-Hold')->
       whereMonth('created_at', '=', $value)
       ->whereYear('created_at', '=', $year)->count();

       $ideaAnalyticsOnHold[$ideaAnalyticsOnHoldIndex]=[
        'month'=>$value,
        'year'=>$year,
        'amount'=>$ideaAnalyticsOn

       ];

        $ideaAnalyticsComp=Idea::where('status','Completed')->
       whereMonth('created_at', '=', $value)
       ->whereYear('created_at', '=', $year)->count();

       $ideaAnalyticsCompleted[$ideaAnalyticsCompletedIndex]=[
        'month'=>$value,
        'year'=>$year,
        'amount'=>$ideaAnalyticsComp

       ];

$ideaAnalyticsNewIndex++;
$ideaAnalyticsInProcessIndex++;
$ideaAnalyticsOnHoldIndex++;
$ideaAnalyticsCompletedIndex++;
$ideaAnalyticsNewIndex++;
}  


$userCount=User::count();  
$RoleCount=Role::count();
$totalIdea=Idea::count();

        return view('dashboard.dashboard',compact(
            'ideaAnalyticsNew',
            'year',
            'ideaAnalyticsInProcess',
            'ideaAnalyticsOnHold',
            'totalIdea',
            'RoleCount',
            'userCount',
            'ideaAnalyticsCompleted'
        ));

        }

      

}
