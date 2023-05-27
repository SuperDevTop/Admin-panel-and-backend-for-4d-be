<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeHistory;
use App\Models\Limit;

use stdClass;

class PageController extends Controller
{
    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("pages.{$page}")) {
            return view("pages.{$page}");
        }

        if($page == 'm' || $page == 'd' || $page == 't' || $page == 's') {
            $company = $page;
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
    
            // // return redirect()->route('page', ['page' => 'profile']);
            // $page = 'activities';
            // if (view()->exists("pages.{$page}")) {
            //     return view("pages.{$page}");
            // }
            return view('pages.activities', 
                        compact('beAnalysis', 'limit_sold_out_big', 'limit_sold_out_small', 'total_big', 'total_small',
                        'total_big_excess', 'total_small_excess', 'limit_big', 'limit_small')
                    );
        }

        return abort(404);
    }

    public function vr()
    {
        return view("pages.virtual-reality");
    }

    public function rtl()
    {
        return view("pages.rtl");
    }

    public function profile()
    {
        return view("pages.profile-static");
    }

    public function signin()
    {
        return view("pages.sign-in-static");
    }

    public function signup()
    {
        return view("pages.sign-up-static");
    }
}
