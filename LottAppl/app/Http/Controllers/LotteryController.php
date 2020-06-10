<?php

namespace App\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Lottery;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Query\Builder;
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
        // $lottos = DB::table('lotteries')
        //     ->orderBy('date', 'desc')
            // ->orderByRaw('CAST(date as DATE) DESC') 
            // ->simplePaginate(7)
            //->get()
        $lottos = Lottery::orderBy('date','DESC')->simplePaginate(7);
        // dd($lottos);
        // $lottos = Lottery::select('date', 'desc')->paginate(10);
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
        // $date = Carbon::CreateFromFormat('d-m-Y',$request->date)->format('Y-m-d');
        // // dd($date , $request->date);
        // $lott = Lottery::where('date',$date)->first();
        // if (empty($lott)){
        //     $lott = new Lottery;
        //     $lott->date = $date; 
        // }
        // dd($lott->date);
        $lott = Lottery::updateOrCreate(
            ['date' =>  formatDateDB($request['date'])], //Carbon::CreateFromFormat('d-m-Y',$request['date'])->format('Y-m-d')
            ['result' => $request['result']]
        );  
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
        $lott = Lottery::updateOrCreate(
            ['date' =>  formatDateDB($request['date'])],
            ['result' => $request['result']]
        );
        // $lott = Lottery::find($id);
        // $lott->date = $request->input('date');
        // $lott->result = $request->input('result');
        // $lott->save();
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
        $search1 = formatDateDB($request->get('search1')); //date
        $search2 = $request->get('search2'); //email
        if (empty($search1)) {
            $lottos = DB::table('lotteries')->where('result', 'LIKE', '%' . $search2)->orderBy('date', 'desc')->simplePaginate(7);
        } else if (empty($search2)) {
            $lottos = DB::table('lotteries')->where('date', 'LIKE', '%' . $search1 . '%')->orderBy('date', 'desc')->simplePaginate(7);
        } else
            $lottos = DB::table('lotteries')->where('date', 'LIKE', '%' . $search1 . '%')->where('result', 'LIKE', '%' . $search2)->orderBy('date', 'desc')->simplePaginate(7);
        return view('lottery.index', ['lottos' => $lottos]);
    }
    // public function getTime()
    // {
    //     $date = Carbon::now('Asia/Ho_Chi_Minh')->subDay()->format('d-m-y');
    //     return view('lottery.test', ['date' => $date]);
    // }
    public function crawlEdit()
    {
        return view('lottery.crawl');
    }

    public function crawlAction(Request $request)
    {
        // $date = Carbon::now('Asia/Ho_Chi_Minh')->subDays(3)->format('d-m-yy');

        $input = $request->input('date');
        $result['date'] = formatDateDB($input);
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

    public function crawlActionTST(Request $request)
    {
        // $date = Carbon::now('Asia/Ho_Chi_Minh')->subDays(3)->format('d-m-yy');

        $input = $request->input('date');
        $result['date'] = formatDateDB($input);
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

    public function crawlTEST()
    {
        $from = Carbon::now('Asia/Ho_Chi_Minh')->subDays(3)->format('d-m-yy');
        $to = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-yy');
        $period = CarbonPeriod::create($from, $to);
        foreach ($period as $date) {
            $url = 'https://xoso.com.vn/xsmb-' . $date->format('d-m-yy') . '.html';
            $html = (new HtmlWeb())->load($url);
            $item['date'] = formatDateDB($date);
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
        if ($from < $to) {
            $period = CarbonPeriod::create($from, $to);
        } else {
            $period = CarbonPeriod::create($to, $from);
        }
        foreach ($period as $date) {
            $url = 'https://xoso.com.vn/xsmb-' . $date->format('d-m-Y') . '.html';
            $html = (new HtmlWeb())->load($url);
            $item['date'] = formatDateDB($date);
            $item['result'] = $html->find('span#mb_prizeDB_item0', 0)->plaintext;
            $html->clear();
            unset($html);
            $data[] = $item;
        }
        // $createdTime = Carbon::now('Asia/Ho_Chi_Minh');
        foreach ($data as $item) {
            $lott = Lottery::updateOrCreate(
                ['date' => $item['date']],
                ['result' => $item['result']]
            );
        }
        // foreach ($data as $importData) {
        //     $insertData = array(
        //         'date' => $importData['date'],
        //         'result' => $importData['result'],
        //         'created_at' => $createdTime,
        //         'updated_at' => $createdTime,
        //     );
        //     Lottery::insertData($insertData);
        // }
        return redirect()->route('lottery.index')->with('success', 'Crawled');;
    }

    public function uploadView()
    {
        return view('lottery.upload');
    }
    public function uploadFile(Request $request)
    {
        $file = $request->file('file');

        //file details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileSize = $file->getSize();
        $createdTime = Carbon::now('Asia/Ho_Chi_Minh');
        //csv validation
        $extValidation = ['csv'];

        //max size for upload
        $maxSize = 2097152;

        if (in_array(strtolower($extension), $extValidation)) {
            if ($fileSize <= $maxSize) {
                $location = 'uploads';
                $file->move($location, $filename);              // move file to its path to read
                $filepath = public_path($location . "/" . $filename);
                $file = fopen($filepath, "r");                 // Reading file
                $importData_arr = array();
                $i = 0; //starting row to read 
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                    $num = count($filedata); //count row number
                    if ($i == 0) {
                        $i++; //skip row 0 because it's column name
                        continue;
                    }
                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c]; //import row into array of import data
                    }
                    $i++;
                }
                fclose($file);
                foreach ($importData_arr as $importData) {
                    $insertData = array(
                        'date' => $importData[0],
                        'result' => $importData[1],
                        'created_at' => $createdTime,
                        'updated_at' => $createdTime,
                    );
                    Lottery::insertData($insertData);
                }
                Session::flash('message', 'Import Successful.');
            } else {
                Session::flash('message', 'File too large. File must be less than 2MB.');
            }
        } else {
            Session::flash('message', 'Invalid File Extension.');
        }
        return redirect()->route('lottery.index');
    }
}
