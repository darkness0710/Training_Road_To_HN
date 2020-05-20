<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    // public function index()
    // {
    //     return view('pages.index');
    // }
    // public function about()
    // {
    //     return view('pages.about');
    // }

    public function index()
    {
        $title = 'Welcome my dude';
        return view('pages.index', compact('title'));
    }

    public function about()
    {
        $name = '420_BLADEAD_69';
        return view('pages.about')->with('name',$name);
    }

    public function services()
    {
        $data = [
            'title' => 'Services',
            'services' =>['Bay','Bien Hinh','69']

        ];
        return view('pages.services')->with($data);
    }
}
