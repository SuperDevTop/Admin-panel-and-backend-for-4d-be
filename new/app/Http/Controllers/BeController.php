<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeHistory;
use App\Models\Limit;
use App\Models\RankNumber;
use App\Models\User;
use Carbon\Carbon;
use stdClass;

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

        $total = ($big + $small) * strlen($company);

        // Change 'big' and 'small' based on the count of permutations.
        if($roll == 'pao') {
            $total = ($big + $small) * strlen($company) * $permutationCount;
        } else if($roll == 'i-box') {
            $big = (float)$big / $permutationCount;
            $small = (float)$small / $permutationCount;
        }

        // Change balances
        $user = User::where('id', $userid)->first();

        $current_spent = $user->spent;
        $current_pointsavailable = $user->pointsavailable;

        $new_spent = $current_spent + $total;
        $new_pointsavailable = $current_pointsavailable - $total;

        if($new_pointsavailable < 0) {
            return response([
                'result' => 0
            ]);
        }

        $user->spent = $new_spent;
        $user->pointsavailable = $new_pointsavailable;

        $user->save();

        $set = array(); // permutation set
        $permutationCount = 0;

        // Getting permutations
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
            
        $ticketno = 1;
        $lastRow = BeHistory::orderBy('created_at', 'desc')->latest()->first();

        if($lastRow) {
            $ticketno = $lastRow->ticketno + 1; 
        }
              
        // Save bet history 
        $behistory = new BeHistory();

        $behistory->userid = $userid;
        $behistory->number = $number;
        $behistory->big = $big;
        $behistory->small = $small;
        $behistory->company = $company;
        $behistory->ticketno = $ticketno;
        $behistory->total = $total;
        $behistory->roll = $roll;

        $behistory->save();
        /////////////////////////////

        // in the case where multiple bets are done in a ticket 
        $row_count = BeHistory::all()->count();

        if($row_count > 1) {
            $latestrow = BeHistory::orderBy('id', 'desc')->latest()->first(); 
            $secondlatestrow = BeHistory::orderBy('id', 'desc')->skip(1)->first(); 

            $from = Carbon::createFromFormat('Y-m-d H:i:s', $secondlatestrow->updated_at);
            $to = Carbon::createFromFormat('Y-m-d H:i:s', $latestrow->created_at);
            $diffinseconds = $to->diffInSeconds($from);

            if( $diffinseconds <= 3 ) {
                $latestrow->created_at = $secondlatestrow->created_at;
                $latestrow->ticketno = $ticketno - 1;
                $latestrow->save();
            }
        }

        return response([
            'result' => 1
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
        $userid = $request->id;
        $histories = BeHistory::orderBy('id', 'desc')->where('userid', $userid)->get();

        return response([
            'histories' => $histories
        ]);
    }

    // For one company
    // public function rankNumbers()
    // {
    //     # code...
    //     $ranknumbers = RankNumber::all()->pluck('ranknumber')->toArray();

    //     return response([
    //        'ranknumbers' => $ranknumbers 
    //     ]);
    // }

    // For 4 companies
    public function rankNumbers(Request $request)
    {
        # code...
        $company = $request->company;
        $ranknumbers = RankNumber::where('company', 'Like', '%'.$company.'%')->pluck('ranknumber')->toArray();

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

    // Add points by admin
    public function addPoint(Request $request)
    {
        # code...
        $point = $request->point;
        $phoneNumber = $request->phoneNumber;

        $selectedUser = User::where('phoneNumber', $phoneNumber)->get()->first();

        $selectedUser->reload = $selectedUser->reload + $point;
        $selectedUser->pointsavailable = $selectedUser->pointsavailable + $point;

        $reload = $selectedUser->reload;
        $pointsavailable = $selectedUser->pointsavailable;

        $selectedUser->save();

        return response([
            'msg'=> 'success',
            'reload' => $reload,
            'pointsavailable' => $pointsavailable 
        ]);
    }

    public function getPointBalance(Request $request)
    {
        # code...
        $id = $request->user_id;
        $balance = User::where('id', $id)->get()->first()->pointsavailable;

        return response([
            'balance' => $balance
        ]);
    }

    public function getDetails($bettingno, $company)
    {
        # code...
        $history = BeHistory::where([
                ['number', '=', $bettingno],
                ['company', 'LIKE', '%'.$company.'%']
            ])->get();

        foreach ($history as $key => $row) {
            # code...
            $userid = $row->userid;
            $row['phoneNumber'] = User::where('id', $userid)->first()->phoneNumber;
        }

        return response ([
            'history' => $history
        ]);
    }

    public function movePoint(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $amount = $request->amount;

        $count = User::where('phoneNumber', $to)->get()->count();

        if($count == 0) {
            return response()->json([
                'result' => '1'
            ]);
        }

        $fromUser = User::where('phoneNumber', $from)->first();
        $pointsavailable = $fromUser->pointsavailable - $amount;
        $spent = $fromUser->spent + $amount;
        $fromUser->pointsavailable = $pointsavailable;
        $fromUser->spent = $spent;
        $fromUser->save();

        $toUser = User::where('phoneNumber', $to)->first();
        $pointsavailable = $toUser->pointsavailable + $amount;
        $reload = $toUser->reload + $amount;
        $toUser->pointsavailable = $pointsavailable;
        $toUser->reload = $reload;
        $toUser->save();

        return response()->json([
            'result' => '2'
        ]);
    }

    public function getTableData(string $company)
    {
        # code...
        $ranknumbers = BeHistory::where('company', 'LIKE', '%'.$company.'%')->pluck('number')->toArray();
        $ranknumbers = array_unique($ranknumbers);
        $beAnalysis = [];

        $limit = Limit::all()->first();
        $limit_big = $limit->big;
        $limit_small = $limit->small;
        $limit_sold_out_big = $limit->sold_out_big;
        $limit_sold_out_small = $limit->sold_out_small;

        $total_big = 0;
        $total_small = 0;
        $total_big_excess = 0;
        $total_small_excess = 0;

        foreach($ranknumbers as $num)
        {
            $big = BeHistory::where([
                                        ['number', '=', $num],
                                        ['company', 'LIKE', '%'.$company.'%']
                                    ])->sum('big');

            $small = BeHistory::where([
                                        ['number', '=', $num],
                                        ['company','LIKE', '%'.$company.'%']
                                    ])->sum('small');

            $total_customer = BeHistory::where([
                                                    ['number', '=', $num],
                                                    ['company','LIKE', '%'.$company.'%']
                                                ])->count();

            if(!$total_customer)
            {
                continue;
            }

            $excess_big = $big - $limit_big;
            $excess_small = $small - $limit_small;

            $excess_big = $excess_big < 0 ? 0 : $excess_big;
            $excess_small = $excess_small < 0 ? 0 : $excess_small;

            if($big > $limit_sold_out_big)
            {
                $excess_big = 0;
            }

            if($small > $limit_sold_out_small)
            {
                $excess_small = 0;
            }

            $ele = new stdClass();
            $ele->total_customer = $total_customer;
            $ele->betno = $num;
            $ele->big = $big;
            $ele->small = $small;
            $ele->excess_big = $excess_big;
            $ele->excess_small = $excess_small;

            array_push($beAnalysis, $ele);

            $total_big += $big;
            $total_small += $small;
            $total_big_excess += $excess_big;
            $total_small_excess += $excess_small;
        } 

        // return redirect()->route('page', ['page' => 'profile']);
        $page = 'activities';
        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}");
        }
        return view('pages.profile-static', 
                    compact('beAnalysis', 'limit_sold_out_big', 'limit_sold_out_small', 'total_big', 'total_small',
                    'total_big_excess', 'total_small_excess', 'limit_big', 'limit_small')
                );
        // return response()->json([
        //     'beAnalysis' => $beAnalysis,
        //     'limit_sold_out_big' => $limit_sold_out_big,
        //     'limit_sold_out_small' => $limit_sold_out_small,
        //     'total_big' => $total_big,
        //     'total_small' => $total_small,
        //     'total_big_excess' => $total_big_excess,
        //     'total_small_excess' => $total_small_excess,
        //     'limit_big' => $limit_big,
        //     'limit_small' => $limit_small,
        //     'limit_sold_out_big' => $limit_sold_out_big,
        //     'limit_sold_out_small' => $limit_sold_out_small
        // ]);
    }
}
