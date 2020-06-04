<?php

namespace App\Http\Controllers;

use App\Mail\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $user= auth()->user();
        Mail::to($user)->send(new Newsletter($user));
        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
       }else{
            return response()->success('Great! Successfully send in your mail');
          }
    }
}
