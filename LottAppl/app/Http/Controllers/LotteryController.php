<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {   
        $this->validate($request, [
            'date' => 'required',
            'result' => 'required'
        ]);
        $attribute = $request->all();
        $this->lotteryRepository->store($attribute);
        return redirect()->route('lottery.index')->with('success', $attribute['date'] . ' Result added');
    }

    public function show($id)
    {
        $lott = $this->lotteryRepository->findById($id);
        dd($lott);
        // return view('lottery.show', ['lott' => $lott]);
    }
}
