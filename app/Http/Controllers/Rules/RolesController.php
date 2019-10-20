<?php

namespace App\Http\Controllers\Rules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        return view('dashboard.rules.add');
      
    }
    public function show()
    {
        $TableData = Role::orderBy('id','desc')->select('*')->paginate(15);
 
      
        return view('dashboard.rules.all')
               ->with('TableData',$TableData);
      
    }
        public function search()
    {

    $q = Input::get ( 'query' );
    if($q != ""){
        
    $SearchData = Role::where(function ($logic) {
    $q=Input::get ( 'query' );
    $logic->where ( 'role', 'LIKE', '%' . $q . '%' )
    ->orWhere ( 'id', 'LIKE', '%' . $q . '%' )
    ->orWhere ( 'created_at', 'LIKE', '%' . $q . '%' )
    ->orWhere ( 'updated_at', 'LIKE', '%' . $q . '%' );
    })->paginate (15)->setPath ( '' );
    $pagination = $SearchData->appends ( array (
                'query' => Input::get ( 'query' ) 
        ) );
    if (count ( $SearchData ) > 0)
        return view ( 'dashboard.rules.all' )->withDetails ( $SearchData )->withQuery ( $q );
    }
        return view ( 'dashboard.rules.all')->withMessage ( 'No Details found. Try to search again !' );
    
      
    }

    public function edit($id)
    {

        if(Role::where('id',$id)->exists()){
            $data = Role::find($id);
            return view('dashboard.rules.edit')
                   ->with('data',$data);
        }
        else{
            return redirect()->route('roles.all');
        }
    
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'role' => 'required|max:255|unique:roles,role',
        ]);

        $Role= new Role();
        $Role->role=$request->role;
        $Role->save();
        
        $notification = array(
            'TaskSuccess' => 'Role Successfully Added',
            'msg' => 'You have added a role',
        );
         return back()->with($notification);
    }

    public function update(Request $request, $id)
    {

    
        $this->validate($request,[
            'role' => 'required|max:255',
        ]);

        if(Role::where('role',$request->role)->where('id','!=',$id)->exists()){
            return back()->withErrors(['role'=>"This role is already exists."])->withInput();
          }

        if(Role::where('id',$id)->exists()){

            $Role=Role::find($id);
            $Role->role=$request->role;
            $Role->save();

            $notification = array(
                'TaskSuccess' => 'Role Successfully Updated',
                'msg' => 'You have updated a role',
            );
            return back()->with($notification);
        }
        else{
          
            $notification = array(
                'TaskError' => 'Role Not Found',
                'msg' => 'You have entered a wrong role',
            );
             return back()->with($notification);
        }
    
     
    }



    public function destroy(Request $request)
    {
        Role::find ( $request->id )->delete ();
        return response ()->json ();
    }
}
