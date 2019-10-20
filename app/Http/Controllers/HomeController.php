<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Idea;
use Illuminate\Support\Facades\Input;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

            if(Auth::user()==null){



             $Ideas = Idea::orderBy('id','desc')->select('*')->with('comments')->paginate(15);
            return view('frontend.index')->with('Ideas',$Ideas);
            }

            else{

            if(Auth::user()->role->role_id==1){

            return redirect()->route('dashboard');
            }
            else{

            $Ideas = Idea::orderBy('id','desc')->select('*')->with('comments')->paginate(15);

                       return view('frontend.index')->with('Ideas',$Ideas);

            }
            }
        
    }

    
           public function fullIdea($id)
    {

        if(Idea::where('id',$id)->exists()){
Idea::find ($id)->increment('view');

            $data = Idea::find($id);
            return view('frontend.full_idea')
                   ->with('data',$data);
        }
        else{
            return redirect()->route('homepage');
        }
    
    }

    public function sort($query)
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

    
      
        return view('frontend.index')
               ->with('Ideas',$TableData)
               ->with('query',$query);
      
    }

        public function search()
    {

    $q = Input::get ( 'query' );
    if($q != ""){
        
    $SearchData = Idea::join('users','ideas.user_id','=','users.id')->where(function ($logic) {
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


    }
