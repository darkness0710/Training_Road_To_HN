<?php
namespace App\Http\Controllers;

use App\Http\Requests\CrawlRequest;
use App\Http\Requests\CSVRequest;
use App\Http\Requests\LotteryRequest;
use App\Repositories\Interfaces\LotteryRepositoryInterface;
use GuzzleHttp\Middleware;

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
        $request->validated();
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
        $request->validated();
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

    public function crawlToDbAction(CrawlRequest $request)
    {
        $request->validated();
        $attribute=$request->all();
        $this->lotteryRepository->crawl($attribute);
        return redirect()->route('lottery.index')->with('success', 'Crawled');;
    }

    public function uploadView()
    {
        return view('lottery.upload');
    }

    public function uploadFile(CSVRequest $request)
    {
        $request->validated();
        $file = $request->file('file');
        $this->lotteryRepository->fromCSV($file);
        return redirect()->route('lottery.index');
    }


}
