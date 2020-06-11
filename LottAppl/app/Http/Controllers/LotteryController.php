<?php

namespace App\Http\Controllers;

use App\Http\Requests\CrawlRequest;
use App\Http\Requests\CSVRequest;
use App\Http\Requests\LotteryRequest;
use App\Http\Requests\SearchRequest;
use App\Services\LotteryService;
use GuzzleHttp\Middleware;

class LotteryController extends Controller
{
    protected $lotteryService;

    public function __construct(LotteryService $lotteryService)
    {
        $this->lotteryService = $lotteryService;
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    public function index()
    {
        $lottos = $this->lotteryService->all();
        return view('lottery.index')->with('lottos', $lottos);
    }

    public function add()
    {
        return view('lottery.add');
    }

    public function create(LotteryRequest $request)
    {
        $input = $request->validated();
        // $input = $request->all();
        $this->lotteryService->create($input);
        return redirect()->route('lottery.index')->with('success', trans('messages.lottery.create.success', ['date' => $input['date']]));
    }

    public function show($id)
    {
        $lott = $this->lotteryService->find($id);
        return view('lottery.show', ['lott' => $lott]);
    }

    public function edit($id)
    {
        $lott = $this->lotteryService->find($id);
        return view('lottery.edit')->with('lott', $lott);
    }

    public function update($id, LotteryRequest $request)
    {
        $input = $request->validated();
        // $input = $request->all();
        $this->lotteryService->update($id, $input);
        return redirect()->route('lottery.index')->with('success', trans('messages.lottery.update.success', ['date' => $input['date']]));
    }

    public function delete($id)
    {
        $lott = $this->lotteryService->destroy($id);;
        return redirect()->route('lottery.index')->with('success', trans('messages.lottery.delete.success'));
    }

    public function search(SearchRequest $request)
    {
        $input = $request->validated();
        $lottos = $this->lotteryService->search($input);
        return view('lottery.index', ['lottos' => $lottos]);
    }

    public function crawlToDb()
    {
        return view('lottery.crawltoDB');
    }

    public function crawlToDbAction(CrawlRequest $request)
    {
        $input = $request->validated();
        // $input=$request->all();
        $this->lotteryService->crawl($input);
        return redirect()->route('lottery.index')->with('success', trans('messages.lottery.crawl.success'));;
    }

    public function uploadView()
    {
        return view('lottery.upload');
    }

    public function uploadFile(CSVRequest $request)
    {
        $request->validated();
        $file = $request->file('file');
        $this->lotteryService->fileUpload($file);
        return redirect()->route('lottery.index')->with('success', trans('messages.lottery.upload.success'));
    }
}
