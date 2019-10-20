<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Role;
use App\UserRole;
class UserController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles=Role::pluck('role','id');
      
        return view('dashboard.users.add')
        ->with('roles',$roles);
      
    }
    public function show()
    {
        $TableData = User::orderBy('id','desc')->select('*')->paginate(15);
 
      
        return view('dashboard.users.all')
               ->with('TableData',$TableData);
      
    }
    public function search()
    {

    $q = Input::get ( 'query' );
    if($q != ""){
        
    $SearchData = User::where(function ($logic) {
    $q=Input::get ( 'query' );
    $logic->where ( 'name', 'LIKE', '%' . $q . '%' )
    ->orWhere ( 'email', 'LIKE', '%' . $q . '%' )
    ->orWhere ( 'created_at', 'LIKE', '%' . $q . '%' )
    ->orWhere ( 'updated_at', 'LIKE', '%' . $q . '%' );
    })->paginate (15)->setPath ( '' );
    $pagination = $SearchData->appends ( array (
                'query' => Input::get ( 'query' ) 
        ) );
    if (count ( $SearchData ) > 0)
        return view ( 'dashboard.users.all' )->withDetails ( $SearchData )->withQuery ( $q );
    }
        return view ( 'dashboard.users.all')->withMessage ( 'No Details found. Try to search again !' );
    
      
    }

    public function edit($id)
    {

        if(User::where('id',$id)->exists()){

            $data = User::find($id);
            $UserRole = UserRole::where('user_id',$id)->first();
  


            $roles=Role::pluck('role','id');
            return view('dashboard.users.edit')
                   ->with('data',$data)
                   ->with('UserRole',$UserRole)
                   ->with('roles',$roles);
        }
        else{
            return redirect()->route('users.all');
        }
    
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|exists:roles,id',
        ]);

        $User= new User();
        $User->name=$request->name;
        $User->email=$request->email;
        $User->password=Hash::make($request->password);
        $User->save();
        
        $UserRole= new UserRole();
        $UserRole->role_id=$request->role;
        $UserRole->user_id=$User->id;
        $UserRole->save();
        
        $notification = array(
            'TaskSuccess' => 'User Successfully Added',
            'msg' => 'You have added an user',
        );

        return redirect()->route('users.edit',$User->id)->with($notification);
    }



    public function update(Request $request, $id)
    {

    
        $this->validate($request,[
            'name' => 'required|alpha|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|exists:roles,id',
        ]);


        if(User::where('name',$request->name)->where('id','!=',$id)->exists()){
            return back()->withErrors(['name'=>"This name is already exists."])->withInput();
          }
        if(User::where('email',$request->email)->where('id','!=',$id)->exists()){
            return back()->withErrors(['email'=>"This email is already exists."])->withInput();
          }

        if(User::where('id',$id)->exists()){

            $User=User::find($id);
            $User->name=$request->name;
            $User->email=$request->email;
            if($request->password){
                $User->password=Hash::make($request->password);
            }
           
            $User->save();

            $notification = array(
                'TaskSuccess' => 'User Successfully Updated',
                'msg' => 'You have updated an user',
            );
            return back()->with($notification);
        }
        else{
          
            $notification = array(
                'TaskError' => 'User Not Found',
                'msg' => 'You have entered a wrong User',
            );
             return back()->with($notification);
        }
    
     
    }



    public function destroy(Request $request)
    {
        User::find ( $request->id )->delete ();
        
        return response ()->json ();
    }


}
