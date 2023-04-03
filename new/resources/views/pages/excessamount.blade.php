<?php
    use App\Models\User;
    use App\Models\RankNumber;
    use App\Models\BeHistory;
    use App\Models\Limit;

    $ranknumbers = RankNumber::all()->pluck('ranknumber')->toArray();
    $excessAmount = [];

    $limit = Limit::all()->first();
    $limit_big = $limit->big;
    $limit_small = $limit->small;
    $limit_sold_out_big = $limit->sold_out_big;
    $limit_sold_out_small = $limit->sold_out_small;

    $total_big_excess = 0;
    $total_small_excess = 0;

    foreach($ranknumbers as $num)
    {
        $big = BeHistory::where('number', $num)->sum('big');
        $small = BeHistory::where('number', $num)->sum('small');
        $total_customer = BeHistory::where('number', $num)->count();

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

        if ($excess_big || $excess_small) {
            # code...
            $ele = new stdClass();
            $ele->betno = $num;
            $ele->excess_big = $excess_big;
            $ele->excess_small = $excess_small;
            array_push($excessAmount, $ele);

            $total_big_excess += $excess_big;
            $total_small_excess += $excess_small;
        }
    }
?>
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Excess Amount'])
    <div class="container-fluid py-4">        
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Excess Amount</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0 admin_activities_1">
                                <thead>
                                    <tr>
                                        <th 
                                            class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                            Bettting No</th>
                                        <th
                                            class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                            Big</th>
                                        <th
                                            class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                            Small</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($excessAmount as $ele)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="font-weight-bold mb-0"> {{ $ele->betno }} </p>                
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="font-weight-bold mb-0">{{ $ele->excess_big }}</p>
                                        </td>
                                        <td class="text-center align-middle">
                                            <p class="font-weight-bold mb-0">{{ $ele->excess_small }}</p>
                                        </td>                                        
                                    </tr>
                                    @endforeach
                                    <tr class="text-info">
                                        <td class="align-middle text-center">
                                            <p class="font-weight-bold mb-0"> <strong>Total </p>                
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="font-weight-bold mb-0">{{ $total_big_excess }}</p>
                                        </td>
                                        <td class="text-center align-middle">
                                            <p class="font-weight-bold mb-0">{{ $total_small_excess }}</p>
                                        </td>                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>         
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
