<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('manager.user.index')->with('users',$users);
    }
    public function view($id)
    {
        $users_view = User::where('id',$id)->first();

        return view('manager.user.view')->with('user',$users_view);
    }

    public function approve($id)
    {

       
        $record = User::find($id);
        $record->status = '1';
        $record->save();
        return redirect('manager/user_approval');
    }

    public function decline($id)
    {

       
        $record = User::find($id);
        $record->status = '2';
        $record->save();
        return redirect('manager/user_approval');
    }


}
