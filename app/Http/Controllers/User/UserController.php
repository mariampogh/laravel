<?php

namespace Laravel\Http\Controllers\User;

use Illuminate\Http\Request;
use Laravel\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Profession;
use Laravel\UserCv;
use Laravel\User;

class UserController extends Controller
{
	public function __construct()
    {
        $this->middleware('authUser');
    }

      public function index()
    {
    	if(Auth::user()->cv == 1){
    		$cv = $this->getUserCV();
    		return view('user.userCv')->with('cv', $cv);
    	}
    	else{
    		$professions = Profession::all();
        	return view('user.home')->with('professions', $professions);
    	}
    	
    }

    public function getUserCV(){

    	$user_id  = Auth::user()->id;
    	return User::find($user_id)->userCv()->get();
    }

    public function cv($id){
    	if(Auth::user()->cv == 1){
    		$cv = $this->getUserCV();
    		return view('user.userCv')->with('cv', $cv);
    	}
    
		$questions = Profession::find($id)->questions()->get();
		return view('user.blankCv')->with('questions', $questions);
    }

    public function createCv(Request $request){
    	$count = (count($request->all()) -1 )/2;
    	$user_id  = Auth::user()->id;
    	$countAnswears = 0;
    	for($i = 0; $i < $count; $i++ ){
    		$question = "question".$i;
    		$answear = "answear".$i;
    		
    		if(!is_null($request->$answear)){
    			$userCv = new UserCv;
    			$userCv->user_id = $user_id;
    			$userCv->question = $request->$question;
    			$userCv->answear = $request->$answear;
    			$userCv->save();
    			$countAnswears++;
    		}
    	}
    	if($countAnswears != 0){
    		$user = User::find($user_id);
	    	$user->cv = 1;
	    	$user->save();
    	}
		
    	return redirect()->route('home');
    }

    public function changeInfoPage(){
        $id = Auth::user()->id;
        $info = User::find($id);

        return view('user.changeInfo')->with('info' , $info);
    }

    public function changePwd(Request $request){
        $validator = $this->validate($request,[  
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('home');
    }

    public function editInfo(Request $request){
        $validator = $this->validate($request,[
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email|max:255',
        ]);
       
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('changeInfoPage');
    }

    public function userCv(){
        if(Auth::user()->cv == 1){
            $cv = $this->getUserCV();
            return view('user.editUserCv')->with('cv', $cv);
        }
        return redirect()->back();
                
    }
    public function editCv(Request $request){
  
        $count = (count($request->all()) - 1 )/2;
        $user_id  = Auth::user()->id;
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
            return redirect()->route('home');
        }

        return redirect()->route('user.userCV');
    }

}
