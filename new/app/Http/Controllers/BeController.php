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

        $roll = $request->roll;
        $userid = $request->id;
        $number = $request->number;
        $big = $request->big;
        $small = $request->small;
        $company = $request->company;
        $total = 0;

        $set = array(); // permutation set
        $permutationCount = 0;

        // getting permutations
        if($roll != 'straight') {
            $a = $number[0];
            $b = $number[1];
            $c = $number[2];
            $d = $number[3];

            array_push($set, $a.$b.$c.$d);
            array_push($set, $a.$b.$d.$c);
            array_push($set, $a.$c.$b.$d);
            array_push($set, $a.$c.$d.$b);
            array_push($set, $a.$d.$b.$c);
            array_push($set, $a.$d.$c.$b);

            array_push($set, $b.$a.$c.$d);
            array_push($set, $b.$a.$d.$c);
            array_push($set, $b.$c.$a.$d);
            array_push($set, $b.$c.$d.$a);
            array_push($set, $b.$d.$a.$c);
            array_push($set, $b.$d.$c.$a);

            array_push($set, $c.$a.$b.$d);
            array_push($set, $c.$a.$d.$b);
            array_push($set, $c.$b.$a.$d);
            array_push($set, $c.$b.$d.$a);
            array_push($set, $c.$d.$a.$b);
            array_push($set, $c.$d.$b.$a);           

            array_push($set, $d.$a.$b.$c);
            array_push($set, $d.$a.$c.$b);
            array_push($set, $d.$b.$a.$c);
            array_push($set, $d.$b.$c.$a);
            array_push($set, $d.$c.$a.$b);            
            array_push($set, $d.$c.$b.$a);  
            
            $set = array_unique($set);
            $permutationCount = count($set);
        }

        $total = ($big + $small) * strlen($company);

        if($roll == 'straight') {
            $total = ($big + $small) * strlen($company) * $permutationCount;
            $big = $big * $permutationCount;
            $small = $small * $permutationCount;
        } else if($roll == 'i-box') {
            $big = (float)$big / $permutationCount;
            $small = (float)$small / $permutationCount;
        }

        // Save bet history 
        $behistory = new BeHistory();

        $behistory->userid = $userid;
        $behistory->number = $number;
        $behistory->big = $big;
        $behistory->small = $small;
        $behistory->company = $company;
        $behistory->ticketno = abs(rand() % 100);
        $behistory->total = $total;

        $behistory->save();
        /////////////////////////////

        // in the case where multiple bets are done in a ticket 
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

        ///////////////

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

    // Getting the time on the server
    public function getTime()
    {
        $time = date('Y-m-d H:i:s');
        $hour = substr($time, 11, 2);

        return response([
            'time' => $time,
            'hour' => $hour
        ]);
    }
}
