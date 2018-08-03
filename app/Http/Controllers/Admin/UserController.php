<?php

namespace Laravel\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\User;
use Laravel\UserCv;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::all();
        $countUsers = $users->count();
        return view('admin.users')->with(['users' => $users, 'countUsers' => $countUsers]); 
    }
    
    public function create()
    {
         return view('admin.addUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.editUserInfo')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validate($request,[
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255',
        ]);
       
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/admin/users');
    }

    public function changePwdAction($id){
        return view('admin.changePwd')
            ->with('id', $id);
    }

    public function changePwd(Request $request){
        $validator = $this->validate($request,[  
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/admin/users');
    }

    public function userCv($id){
        // dd($id);
        if(User::find($id)->cv == 1){
            $cv = User::find($id)->userCv()->get();
            $user = User::find($id);
            return view('admin.userCv')->with(['user' => $user, 'cv' => $cv]);
        }
        else{
            return redirect()->back();
        }
    }

    public function editCv(Request $request){
  
        $count = (count($request->all()) - 2 )/2;
        $user_id  = $request->id;
        $countAnswears = 0;
        for($i = 0; $i < $count; $i++ ){
            $question = "question".$i;
            $answear = "answear".$i;
            $userCv = UserCv::where([
                                ['user_id', $user_id],
                                ['question', $request->$question],
                                
                            ]) ->first();
            if(!is_null($request->$answear)){
                $userCv->answear = $request->$answear;
                $userCv->save();
            }
            else{
                $userCv->delete();
                $countAnswears++;
            }
        }
        if($countAnswears == $count){
            $user = User::find($user_id);
            $user->cv = 0;
            $user->save();
            return redirect()->route('users.index');
        }

        return redirect()->route('admin.userCV', $user_id);
    }
}
