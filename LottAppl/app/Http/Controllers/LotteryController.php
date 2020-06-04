<?php

namespace App\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Lottery;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
// include_once '../vendor/autoload.php';

use simplehtmldom\HtmlWeb;

class LotteryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    public function index()
    {
        // $lotts = DB::table('lotts')->orderbyRaw('created_at DESC')->get();//select all from lotts with sql structures

        $lottos = Lottery::orderBy('created_at', 'desc')->paginate(10);
        return view('lottery.index')->with('lottos', $lottos);
    }
    public function add()
    {
        return view('lottery.add');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'result' => 'required'
        ]);
        $lott = new Lottery;
        $lott->date = $request->input('date');
        $lott->result = $request->input('result');
        $lott->save();
        return redirect()->route('lottery.index')->with('success', $lott->date . ' Result added');
    }
    public function show($id)
    {
        $lott = Lottery::find($id);
        return view('lottery.show', ['lott' => $lott]);
    }
    public function edit($id)
    {
        $lott = Lottery::find($id);
        return view('lottery.edit')->with('lott', $lott);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required',
            'result' => 'required'
        ]);
        $lott = Lottery::find($id);
        $lott->date = $request->input('date');
        $lott->result = $request->input('result');
        $lott->save();
        return redirect()->route('lottery.index')->with('success', $lott->date . ' modified');
    }
    public function delete($id)
    {
        $lott = Lottery::find($id);
        $lott->delete();
        return redirect()->route('lottery.index')->with('success', 'Deleted');
    }
    public function search(Request $request)
    {
        $search1 = $request->get('search1'); //date
        $search2 = $request->get('search2'); //email
        if (empty($search1)) {
            $lottos = DB::table('lotteries')->where('result', 'LIKE', '%' . $search2 . '%')->get();
        } else if (empty($search2)) {
            $lottos = DB::table('lotteries')->where('date', 'LIKE', '%' . $search1 . '%')->get();
        } else
            $lottos = DB::table('lotteries')->where('date', 'LIKE', '%' . $search1 . '%')->where('result', 'LIKE', '%' . $search2 . '%')->get();
        return view('lottery.index', ['lottos' => $lottos]);
    }
    // public function getTime()
    // {
    //     $date = Carbon::now('Asia/Ho_Chi_Minh')->subDay()->format('d-m-y');
    //     return view('lottery.test', ['date' => $date]);
    // }
    public function crawl()
    {
        return view('lottery.crawl');
    }
    public function crawlAction(Request $request)
    {
        // $date = Carbon::now('Asia/Ho_Chi_Minh')->subDays(3)->format('d-m-yy');

        $input = $request->input('date');
        $result['date'] = $input;
        $date = Carbon::create($input)->format('d-m-yy');
        $url = 'https://xoso.com.vn/xsmb-' . $date . '.html';

        $html = (new HtmlWeb())->load($url);
        $result['prize'] = $html->find('span#mb_prizeDB_item0', 0)->plaintext;
        // foreach ($table->find('tr') as $tr) {
        //     $item['col'] = $tr->find('td.giai-txt', 0)->plaintext;
        //     $item['span'] = $tr->find('td.number', 0)->plaintext;
        //     $data[] = $item;
        // }
        // dd($table);
        $html->clear();
        unset($html);

        return view('lottery.crawl', ['result' => $result]);
    }
    public function crawl2()
    {
        $from = Carbon::now()->subDays(3)->format('d-m-yy');
        $to = Carbon::now()->format('d-m-yy');
        $period = CarbonPeriod::create($from, $to);
        foreach ($period as $date) {
            $url = 'https://xoso.com.vn/xsmb-' . $date->format('d-m-yy') . '.html';
            $html = (new HtmlWeb())->load($url);
            $item['date'] = $date->format('d-m-yy');
            $item['result'] = $html->find('span#mb_prizeDB_item0', 0)->plaintext;
            $html->clear();
            unset($html);
            $data[] = $item;
        }
        dd($data);
        // return view('lottery.crawl', ['url'=>$url]);
    }
    public function crawlToDb()
    {
        return view('lottery.crawltoDB');
    }

    public function crawlToDBAction(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
        $period = CarbonPeriod::create($from, $to);
        foreach ($period as $date) {
            $url = 'https://xoso.com.vn/xsmb-' . $date->format('d-m-yy') . '.html';
            $html = (new HtmlWeb())->load($url);
            $item['date'] = $date->format('d-m-yy');
            $item['result'] = $html->find('span#mb_prizeDB_item0', 0)->plaintext;
            $html->clear();
            unset($html);
            $data[] = $item;
        }
        foreach ($data as $item) {
            $lott = Lottery::updateOrCreate(
                ['date' => $item['date']],
                ['result' => $item['result']]
            );
        }
        return redirect()->route('lottery.index')->with('success', 'Crawled');;
    }
}
