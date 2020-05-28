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
        return view('userManager')->with('users', $users);
    }
    public function search(Request $request)
    {
        // $users = DB::table('users')->orderBy('name')->get();
        // return view('userManager')->with('users', $users);

            $search = $request->get('search');
            $users = DB::table('users')->where('name','LIKE',$search);
            return view('userManager')->with('users',$users);
    }
}
