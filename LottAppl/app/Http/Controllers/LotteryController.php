<?php

namespace App\Http\Controllers;

use App\Http\Requests\LotteryRequest;
use App\Http\Requests\storeLottery;
use App\Repositories\Interfaces\LotteryRepositoryInterface;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Lottery;
// use App\Repositories\Lottery;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Query\Builder;
// include_once '../vendor/autoload.php';
use simplehtmldom\HtmlWeb;

class LotteryController extends Controller
{
    protected $lotteryRepository;

    public function __construct(LotteryRepositoryInterface $lotteryRepository)
    {
        $this->lotteryRepository = $lotteryRepository;
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    public function index()
    {
        $lottos = $this->lotteryRepository->getAll();
        return view('lottery.index')->with('lottos', $lottos);
    }

    public function add()
    {
        return view('lottery.add');
    }

    public function store(LotteryRequest $request)
    {
        $validated = $request->validated();
        $attribute = $request->all();
        $this->lotteryRepository->store($attribute);
        return redirect()->route('lottery.index')->with('success', $attribute['date'] . ' Result added');
    }

    public function show($id)
    {
        $lott = $this->lotteryRepository->findById($id);
        return view('lottery.show', ['lott' => $lott]);
    }

    public function edit($id)
    {
        $lott = $this->lotteryRepository->findById($id);
        return view('lottery.edit')->with('lott', $lott);
    }

    public function update($id, LotteryRequest $request)
    {
        $request->validate();
        $attribute = $request->all();
        $this->lotteryRepository->update($id, $attribute);
        return redirect()->route('lottery.index')->with('success', $attribute['date'] . ' modified');
    }

    public function delete($id)
    {
        $lott = $this->lotteryRepository->delete($id);;
        return redirect()->route('lottery.index')->with('success', 'Deleted');
    }

    public function crawlToDb()
    {
        return view('lottery.crawltoDB');
    }

    public function crawlToDbAction(Request $request)
    {
        $attribute=$request->all();
        $this->lotteryRepository->crawl($attribute);
        return redirect()->route('lottery.index')->with('success', 'Crawled');;
    }

    public function uploadView()
    {
        return view('lottery.upload');
    }

    public function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $this->lotteryRepository->fromCSV($file);
        return redirect()->route('lottery.index');
    }


}
