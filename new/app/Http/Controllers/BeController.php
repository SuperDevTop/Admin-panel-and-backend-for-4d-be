<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeHistory;
use App\Models\Limit;
use App\Models\RankNumber;
use Carbon\Carbon;

class BeController extends Controller
{
    //
    public function bet(Request $request)
    {
        # code...
        $behistory = new BeHistory();

        $behistory->userid = $request->id;
        $behistory->number = $request->number;
        $behistory->big = $request->big;
        $behistory->small = $request->small;
        $behistory->company = $request->company;
        $behistory->ticketno = abs(rand() % 100);
        $behistory->total = ($request->big + $request->small) * strlen($request->company);

        $behistory->save();

        $row_count = BeHistory::all()->count();

        if($row_count > 1) {
            $latestrow = BeHistory::orderBy('created_at', 'desc')->latest()->first(); 
            $secondlatestrow = BeHistory::orderBy('created_at', 'desc')->skip(1)->take(1)->first(); 

            $from = Carbon::createFromFormat('Y-m-d H:i:s', $secondlatestrow->created_at);
            $to = Carbon::createFromFormat('Y-m-d H:i:s', $latestrow->created_at);
            $diffinseconds = $to->diffInSeconds($from);

            if($diffinseconds <= 3 ) {
                $latestrow->created_at = $secondlatestrow->created_at;
                $latestrow->save();
            }
        }

        $match = RankNumber::where('ranknumber', $request->number)->first();
        $profit = 0;

        if(!$match) {
            return response ([
                'rank' => 0,
                'profit' => $profit
            ]);
        }

        $rank = $match->rank;

        switch($rank)
        {
            case 1:
                $profit = $request->big * 2000 + $request->small * 1500;
                break;

            case 2:
                $profit = $request->big * 1500 + $request->small * 1000;
                break;

            case 3:
                $profit = $request->big * 1000 + $request->small * 800;
                break;

            case 4:
                $profit = $request->big * 800 + $request->small * 500;
                break;

            case 5:
                $profit = $request->big * 500 + $request->small * 300;
                break;
        }

        return response ([
            'rank' => $rank,
            'profit' => $profit
        ]);
    }

    public function betHistory(Request $request)
    {
        # code...
        $userid = $request->id;
        $histories = BeHistory::where('userid', $userid)->get();

        return response([
            'histories' => $histories
        ]);
    }

    public function ticket(Request $request)
    {
        # code...
        $userid = $request->id;
        $created_at = BeHistory::where('userid', $userid)->latest()->first()->created_at;

        $ticket = BeHistory::where([
                                        ['userid', '=', $userid],
                                        ['created_at', '=', $created_at]
        ])->get();                                 

        $nt = $ticket->sum('total');

        return response ([
            'ticket' => $ticket,
            'nt' => $nt
        ]);
    }

    public function rankNumbers()
    {
        # code...
        $ranknumbers = RankNumber::all()->pluck('ranknumber')->toArray();

        return response([
           'ranknumbers' => $ranknumbers 
        ]);
    }

    public function setLimit(Request $request)
    {
        # code...
        $type = $request->type;
        $value = $request->value;

        $row = Limit::all()->first();

        switch ($type) {
            case 'big':                
                $row->big = $value;
                break;

            case 'small':                
                $row->small = $value;
                break;

            case 'sold_out_big':                
                $row->sold_out_big = $value;
                break;

            case 'sold_out_small':
                $row->sold_out_small = $value;
                break;
            
            default:                
                break;
        }

        $row->save();

        return response([
            'msg' => 'success'
        ]);
    }

    public function getTime()
    {
        $time = date('Y-m-d H:i:s');

        return response([
            'time'=> $time
        ]);
    }
}
