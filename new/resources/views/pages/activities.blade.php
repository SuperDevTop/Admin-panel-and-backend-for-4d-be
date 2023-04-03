<?php
    use App\Models\User;
    use App\Models\RankNumber;
    use App\Models\BeHistory;

    $ranknumbers = RankNumber::all()->pluck('ranknumber')->toArray();
    $beAnalysis = [];

    foreach($ranknumbers as $num)
    {
        $big = BeHistory::where('number', $num)->sum('big');
        $small = BeHistory::where('number', $num)->sum('small');
        $total_customer = BeHistory::where('number', $num)->count();

        if(!$total_customer)
        {
            continue;
        }

        $excess_big = $big - 50;
        $excess_small = $small - 50;

        $excess_big = $excess_big < 0 ? 0 : $excess_big;
        $excess_small = $excess_small < 0 ? 0 : $excess_small;

        $ele = new stdClass();
        $ele->total_customer = $total_customer;
        $ele->betno = $num;
        $ele->big = $big;
        $ele->small = $small;
        $ele->excess_big = $excess_big;
        $ele->excess_small = $excess_small;

        array_push($beAnalysis, $ele
        //  {
        //     'total_customer'=> $total_customer,
        //     'betno'=> $num,
        //     'big'=> $big,
        //     'small'=> $small,
        //     'excess_big'=> $excess_big,
        //     'excess_small'=> $excess_small,
        // }
    );
    }
?>
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Activities'])
    <div class="container-fluid py-4">        
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Admin activities</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0 admin_activities_1">
                                <thead>
                                    <tr>
                                        <th 
                                            class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                            Total Customer</th>
                                        <th
                                            class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                            Betting No.</th>
                                        <th
                                            class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                            Big</th>
                                        <th
                                            class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                            Small</th>
                                        <th
                                            class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                            Excess Amount
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                            Excess Amount
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($beAnalysis as $ele)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0"> {{ $ele->total_customer }} </p>                
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{  $ele->betno  }}</p>
                                        </td>
                                        <td class="text-center align-middle">
                                            <p class="text-sm font-weight-bold mb-0">{{ $ele->big }}</p>
                                        </td>
                                        <td class="align-middle text-center">                                    
                                            <p class="text-sm font-weight-bold mb-0">{{ $ele->small }}</p>
                                        </td>
                                        <td class="align-middle text-center">                                        
                                            <p class="text-sm font-weight-bold mb-0">{{ $ele->excess_big }}</p>
                                        </td>
                                        <td class="align-middle text-center">                                        
                                            <p class="text-sm font-weight-bold mb-0">{{ $ele->excess_small }}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-4">  
                    <div class="card-header pb-0">
                        <h6>Owner Acceptable Limit</h6>
                    </div>             
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">                                
                                <tbody>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">Set limit -Big</p>                
                                        </td>
                                       
                                        <td class="align-middle text-center">                                        
                                            <p class="text-sm font-weight-bold mb-0">50</p>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">Set limit -Small</p>                
                                        </td>
                                       
                                        <td class="align-middle text-center">                                        
                                            <p class="text-sm font-weight-bold mb-0">50</p>
                                        </td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card mb-4">  
                    <div class="card-header pb-0">
                        <h6>Betting Limit</h6>
                    </div>             
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">                                
                                <tbody>
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">Sold out limit -Big</p>                
                                        </td>
                                       
                                        <td class="align-middle text-center">                                        
                                            <p class="text-sm font-weight-bold mb-0">100</p>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">Sold out limit -Small</p>                
                                        </td>
                                       
                                        <td class="align-middle text-center">                                        
                                            <p class="text-sm font-weight-bold mb-0">100</p>
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
