<?php

namespace App\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Lottery;
use Illuminate\Support\Facades\DB;

class LotteryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
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
        // $lott->user_id =auth()->user()->id;
        $lott->save();
        return redirect()->route('lottery.index')->with('success', $lott->date . ' Result added');
    }
    public function show($id)
    {
        $lott = Lottery::find($id);
        return view('lottery.show', ['lott'=> $lott]);
    }
    public function edit($id)
    {
        $lott = Lottery::find($id);
        return view('lottery.edit')->with('lott', $lott);
    }
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'date' => 'required',
            'result' => 'required'
        ]);
        $lott = Lottery::find($id);
        $lott->date = $request->input('date');
        $lott->result = $request->input('result');
        // $lott->user_id =auth()->user()->id;
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
        $search1 = $request->get('search1');
        $search2 = $request->get('search2');
        if (empty($search1)) {
            $lottos = DB::table('lotteries')->where('result', 'LIKE', '%' . $search2 . '%')->get();
        } else if (empty($search2)) {
            $lottos = DB::table('lotteries')->where('date', 'LIKE', '%' . $search1 . '%')->get();
        } else
            $lottos = DB::table('lotteries')->where('date', 'LIKE', '%' . $search1 . '%')->where('result', 'LIKE', '%' . $search2 . '%')->get();
        return view('lottery.index', ['lottos' => $lottos]);
    }
}
