<?php

namespace App\Http\Controllers;

use App\User;
use App\Lottery;
use App\Mail\Newsletter;
use App\Mail\Daily;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmailController extends Controller
{
    public function sendNewsletter()
    {
        Mail::to('test@test.com')->send(new Newsletter);
    }
    public function sendDaily()
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->subDays(1)->format('d-m-yy');
        $lott = DB::table('lotteries')->where('date', 'LIKE', $date)->first();
        $users = DB::table('users')->where('is_subscribed', 'LIKE', '1')->get();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new Daily($lott));
        }
        // dd($lott,$date,$users);
    }
}
