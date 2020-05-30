<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = DB::table('users')->orderBy('name')->get();
        return view('users.index')->with('users', $users);
    }
    public function search(Request $request)
    {
        // $users = DB::table('users')->orderBy('name')->get();
        // return view('userManager')->with('users', $users);

        $search = $request->get('search');
        $users = DB::table('users')->where('name','LIKE','%'.$search.'%')->get();
        return view('users.index',['users'=>$users]);
    }
    public function ban($id)
    {   
        $user = User::find($id);
        if (!$user->is_banned) {
            $user->is_banned = '1';
            $user->save();
        } else {
            $user->is_banned = '0';
            $user->save();

        }
        return redirect('/users');

    }
    public function uprole($id)
    {
        $user = User::find($id);
        if (!$user->is_admin) {
            $user->is_admin = '1';
            $user->save();
        } else {
            $user->is_admin = '0';
            $user->save();

        }
        return redirect('/users');
    }
}
