<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Idea;
use App\Vote;
use App\User;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class IdeaController extends Controller
{
       public function __construct()
    {
        $this->middleware('auth');
    }


    public function show()
    {
        $TableData = Idea::orderBy('id','desc')->select('*')->paginate(15);
      
        return view('dashboard.idea.all')
               ->with('TableData',$TableData);
      
    }



      public function upVote(Request $request)
    {
        Idea::find ($request->id)->increment('up_vote');
        
        $Vote = new Vote();
        $Vote->idea_id=$request->id;
        $Vote->user_id=Auth::user()->id;
        $Vote->impression='1';
        $Vote->save();


        return response ()->json ();
    }
      public function downVote(Request $request)
    {
         Idea::find ($request->id)->increment('down_vote');
        $Vote = new Vote();
        $Vote->idea_id=$request->id;
        $Vote->user_id=Auth::user()->id;
        $Vote->impression='0';
        $Vote->save();
        return response ()->json ();
    }

 
    

    

    public function storeIdea(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|string|max:400',
            'image' => 'nullable|image',
            'idea_description' => 'required|max:1000',
            'pptx' => 'nullable|mimes:pptx,ppt',
            'tags.*' => 'required'
        ]);





        $Idea= new Idea();
        $Idea->user_id=Auth::user()->id;
        $Idea->title=$request->title;


      

         $fileNameToStore = "";

            if ($request->hasFile('image')) {
        
                //file name with extension
                $fileNameWithExt = $request->file('image')->getClientOriginalName();
                //get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //GET JUST EXT
                $extension = $request->file('image')->getClientOriginalExtension();
                //file name to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
    
                //Upload Image
                $path = $request->file('image')->storeAs('public/idea', $fileNameToStore);
    
            } else {
                $fileNameToStore = "";
            }

        $Idea->image=$fileNameToStore;
        $Idea->description=$request->idea_description;


            $PPTfileNameToStore = "";

            if ($request->hasFile('pptx')) {
        
                //file name with extension
                $fileNameWithExt = $request->file('pptx')->getClientOriginalName();
                //get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                //GET JUST EXT
                $extension = $request->file('pptx')->getClientOriginalExtension();
                //file name to store
                $PPTfileNameToStore = $fileName . '_' . time() . '.' . $extension;
    
                //Upload Image
                $path = $request->file('pptx')->storeAs('public/ppt', $PPTfileNameToStore);
    
            } else {
                $PPTfileNameToStore = "";
            }

        $Idea->pptx=$PPTfileNameToStore;
        $Idea->status='New';
        $Idea->up_vote=0;
        $Idea->down_vote=0;
        $Idea->view=0;

        $Idea->save();

      $tagCount=count($request->tags);
 
      for($i=0;$i<$tagCount;$i++){
            $Tag= new Tag();
            $Tag->idea_id=$Idea->id;
            $Tag->tag_name=$request->tags[$i];
            $Tag->save();
      }
   
        
        
        $notification = array(
            'TaskSuccess' => 'Idea Successfully Added',
            'msg' => 'You have added an idea',
        );

        return back()->with($notification);
    }


        public function view($id)
    {

        if(Idea::where('id',$id)->exists()){
            $data = Idea::find($id);
            return view('dashboard.idea.show')
                   ->with('data',$data);
        }
        else{
            return redirect()->route('idea.all');
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

    
      
        return view('dashboard.idea.all')
               ->with('TableData',$TableData)
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
        return view ( 'dashboard.idea.all' )->withDetails ( $SearchData )->withQuery ( $q );
    }
        return view ( 'dashboard.idea.all')->withMessage ( 'No Details found. Try to search again !' );
    
      
    }

    public function status(Request $request)
    {

       $this->validate($request,[
            'item_status' => 'required',
            'item_id' => 'required',
        ]);

        $Idea= Idea::find($request->item_id);
        $Idea->status=$request->item_status;
        $Idea->save();
        
        $notification = array(
            'TaskSuccess' => 'Status Successfully Updated',
            'msg' => 'You have updated a status',
        );
         return back()->with($notification);
    
    }


     public function topVoter()
    {

        $Found=array();
        $st_index=0;
        $users = User::all();
        foreach ($users as $item) {
            $total_Vote=Vote::where('user_id',$item->id)->count();
           $Found[$st_index] = [
                'id' => $item->id,
                'name' => $item->name,
                'vote' =>$total_Vote
            ];
        $st_index++;
            
        }

          $collection=collect($Found);
          $sortedAllResults = $collection->sortByDesc('vote');



      
        return view('dashboard.voter_list')
               ->with('TableData',$sortedAllResults);
      
    }        

    public function topIdeaSubmitters()
    {

        $Found=array();
        $st_index=0;
        $users = User::all();
        foreach ($users as $item) {
            $posts=Idea::where('user_id',$item->id)->count();
           $Found[$st_index] = [
                'id' => $item->id,
                'name' => $item->name,
                'posts' =>$posts
            ];
        $st_index++;
            
        }

          $collection=collect($Found);
          $sortedAllResults = $collection->sortByDesc('posts');


      
        return view('dashboard.top_idea_submitters')
               ->with('TableData',$sortedAllResults);
      
    }

    public function destroy(Request $request)
    {
        Idea::find ( $request->id )->delete ();
        return response ()->json ();
    }
}
