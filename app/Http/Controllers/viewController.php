<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Idea;
use Validator;
use Response;
use App\Comment;
use View;
use App\Wish;
use Illuminate\Support\Facades\Input;

class viewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function viewProfile(){

$totalIdea=Idea::where('user_id',Auth::id())->count();
$totalIdeaCompleted=Idea::where('user_id',Auth::id())->where('status','Completed')->count();
$totalIdeaInProgress=Idea::where('user_id',Auth::id())->where('status','In-Progress')->count();
$totalIdeaOnHold=Idea::where('user_id',Auth::id())->where('status','On-Hold')->count();
$totalIdeaNew=Idea::where('user_id',Auth::id())->where('status','New')->count();


$Ideas=Idea::where('user_id',Auth::id())->orderBy('id','desc')
        ->paginate(15);
        return view('frontend.profile',compact('Ideas','totalIdea','totalIdeaCompleted','totalIdeaInProgress','totalIdeaOnHold','totalIdeaNew'));
    }

    public function submitIdea(){
        return view('frontend.submit-idea');
    }
  public function analytics(){
        return view('frontend.submit-idea');
    }

    public function sortProfile($query)
    {
        if($query=='New'){
            $TableData = Idea::where('status','New')->orderBy('id','desc')->select('*')->paginate(15);
        } 
        else if($query=='In-Progress'){
        $TableData = Idea::where('status','In-Progress')->orderBy('id','desc')->select('*')->paginate(15);
        } 
        else if($query=='Completed'){
        $TableData = Idea::where('status','Completed')->orderBy('id','desc')->select('*')->paginate(15);
        } 
        else if($query=='On-Hold'){
        $TableData = Idea::where('status','On-Hold')->orderBy('id','desc')->select('*')->paginate(15);
        } 
        else if($query=='Up-Voted'){
        $TableData = Idea::where('up_vote','!=','0')->orderBy('up_vote','desc')->select('*')->paginate(15);
        } 
        else if($query=='Down-Voted'){
        $TableData = Idea::where('down_vote','!=','0')->orderBy('down_vote','desc')->select('*')->paginate(15);
        }
        else{
            abort('404',"Something went wrong");
        }


$totalIdea=Idea::where('user_id',Auth::id())->count();
$totalIdeaCompleted=Idea::where('user_id',Auth::id())->where('status','Completed')->count();
$totalIdeaInProgress=Idea::where('user_id',Auth::id())->where('status','In-Progress')->count();
$totalIdeaOnHold=Idea::where('user_id',Auth::id())->where('status','On-Hold')->count();
$totalIdeaNew=Idea::where('user_id',Auth::id())->where('status','New')->count();
    
      return view('frontend.profile',compact('Ideas','query','totalIdea','totalIdeaCompleted','totalIdeaInProgress','totalIdeaOnHold','totalIdeaNew'));
      
    }


public function sortbyWish($query)
    {
        if($query=='New'){
            $TableData = Idea::join('wishes','ideas.id','=','wishes.idea_id')->where('status','New')->orderBy('id','desc')->select('*')->paginate(15);
        } 
        else if($query=='In-Progress'){
        $TableData = Idea::join('wishes','ideas.id','=','wishes.idea_id')->where('ideas.status','In-Progress')->orderBy('ideas.id','desc')->select('ideas.*')->paginate(15);
        } 
        else if($query=='Completed'){
        $TableData = Idea::join('wishes','ideas.id','=','wishes.idea_id')->where('ideas.status','Completed')->orderBy('ideas.id','desc')->select('ideas.*')->paginate(15);
        } 
        else if($query=='On-Hold'){
        $TableData = Idea::join('wishes','ideas.id','=','wishes.idea_id')->where('ideas.status','On-Hold')->orderBy('ideas.id','desc')->select('ideas.*')->paginate(15);
        } 
        else if($query=='Up-Voted'){
        $TableData = Idea::join('wishes','ideas.id','=','wishes.idea_id')->where('ideas.up_vote','!=','0')->orderBy('ideas.up_vote','desc')->select('ideas.*')->paginate(15);
        } 
        else if($query=='Down-Voted'){
        $TableData = Idea::join('wishes','ideas.id','=','wishes.idea_id')->where('ideas.down_vote','!=','0')->orderBy('ideas.down_vote','desc')->select('ideas.*')->paginate(15);
        }
        else{
            abort('404',"Something went wrong");
        }

    
        return view('frontend.wish')
               ->with('Ideas',$TableData)
               ->with('query',$query);
      
    }

        public function searchWish()
    {

    $q = Input::get ( 'query' );
    if($q != ""){
        
    $SearchData = Idea::join('wishes','ideas.id','=','wishes.idea_id')->join('users','ideas.user_id','=','users.id')->where(function ($logic) {
    $q=Input::get ( 'query' );
    $logic->where ( 'users.name', 'LIKE', '%' . $q . '%' )
    ->orWhere ( 'ideas.title', 'LIKE', '%' . $q . '%' )
    ->orWhere ( 'ideas.status', 'LIKE', '%' . $q . '%' );
    })
    ->select('ideas.*','users.name')
    ->paginate (15)->setPath ( '' );
    $pagination = $SearchData->appends ( array (
                'query' => Input::get ( 'query' ) 
        ) );
    if (count ( $SearchData ) > 0)

        return view ( 'frontend.index' )->with('Ideas',$SearchData)->with('q',$q);
    }

        return view ( 'frontend.index')->withMessage ( 'No Details found. Try to search again !' )->with('q',$q);
    
      
    }





    public function allWish(){
        $Ideas=Idea::join('wishes','ideas.id','=','wishes.idea_id')->orderBy('wishes.id','desc')
        ->select('ideas.*','wishes.user_id')
        ->paginate(15);
        return view('frontend.wish')->with('Ideas',$Ideas);
    }  

    public function addWish($id){
        if(Wish::where('idea_id',$id)->where('user_id',Auth::user()->id)->exists()){
            $notification = array(
            'TaskError' => 'Already Added',
            'msg' => 'Something went wrong',
        );

        return back()->with($notification);
        }
        else{
        $Wish = new Wish();
        $Wish->idea_id=$id;
        $Wish->user_id=Auth::user()->id;
        $Wish->save();

         $notification = array(
            'TaskSuccess' => 'Wish Successfully Added',
            'msg' => 'You have added a Wish list',
        );

        return back()->with($notification);
        }
   
    }  

    public function removeWish($id){
         if(Wish::where('idea_id',$id)->where('user_id',Auth::user()->id)->exists()){
            Wish::where('idea_id',$id)->where('user_id',Auth::user()->id)->delete();
         $notification = array(
            'TaskSuccess' => 'Wish Successfully Removed',
            'msg' => 'You have removed a Wish from list',
        );

        return back()->with($notification);
        }
        else{
        abort(404,'Something Went Wrong');
        }
    }

       public function comment(Request $request,$id)
    {
            $this->validate($request,[
            'comment' => 'required'
        ]);
      
        $comments = new Comment();
        $comments->idea_id = $id;
        $comments->user_id = Auth::id();
        $comments->comment = $request->comment;
        $comments->save();
        return back();
    }
    
    
        public function comments(){
            $comments = Comment::latest()->get();
            return  view(' frontend.full_idea')->compact('comments');
    }
    


     


}
