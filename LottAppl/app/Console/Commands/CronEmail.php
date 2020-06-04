<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Lottery;
use App\Mail\Newsletter;
use App\Mail\Daily;
use Carbon\Carbon;


class CronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Lottos result Update by email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-yy');
        $lott = DB::table('lotteries')->where('date', 'LIKE', $date);
        $users = DB::table('users')->where('isSubscribed', 'LIKE', '1')->get();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new Daily($lott));
        }

    }
}
