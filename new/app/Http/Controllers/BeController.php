<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeHistory;
use App\Models\Limit;
use App\Models\RankNumber;

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
        $behistory->total = ($request->big + $request->small) * 8;

        $behistory->save();

        $match = RankNumber::where('ranknumber', $request->number)->first();
        $profit = 0;

        if(!$match)
        {
            return response([
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

        return response([
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
        $ticket = BeHistory::where('userid', $userid)->latest()->first();

        return response([
            'ticket' => $ticket
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

        echo 3;

        switch ($type) {
            case 'big':
                # code...
                $row->big = $value;
                break;
            case 'small':
                # code...
                $row->small = $value;
                break;
            case 'sold_out_big':
                # code...
                $row->sold_out_big = $value;
                break;
            case 'sold_out_small':
                # code...
                $row->sold_out_small = $value;
                break;
            
            default:
                # code...
                break;
        }

        $row->save();

        return response([
            'msg' => 'success'
        ]);
    }
}
