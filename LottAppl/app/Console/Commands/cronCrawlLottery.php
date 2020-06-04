<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Lottery;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use simplehtmldom\HtmlWeb;

class cronCrawlLottery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lottery:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl Lottery Result daily at 18:31';

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
        $result['date'] = $date;
        $url = 'https://xoso.com.vn/xsmb-' . $date . '.html';

        $html = (new HtmlWeb())->load($url);
        $result['prize'] = $html->find('span#mb_prizeDB_item0', 0)->plaintext;
    }
}
