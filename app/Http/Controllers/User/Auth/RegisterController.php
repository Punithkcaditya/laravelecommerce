<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{


    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegisterForm(){
        return view('user.auth.register');
    }

    public function showEditRegisterForm($id){
        $user =User::where('id',$id)->where('status',2)->first();
     if(!empty($user))
     {
              return view('user.auth.edit_register',compact('user'));
     }
     else
     {
        return redirect(route('user.register'));
     }

    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('user.register'))->with('message', 'Your registration is waiting for admin approval');
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status= 0;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect(route('user.register'))->with('message', 'Your registration is waiting for admin approval');
    }
}
