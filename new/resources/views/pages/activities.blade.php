<?php
    use App\Models\User;
    use App\Models\RankNumber;
    use App\Models\BeHistory;
    use App\Models\Limit;

    $ranknumbers = RankNumber::all()->pluck('ranknumber')->toArray();
    $beAnalysis = [];

    $total_big = 0;
    $total_small = 0;
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

        array_push($beAnalysis, $ele);

        $total_big += $big;
        $total_small += $small;
        $total_big_excess += $excess_big;
        $total_small_excess += $excess_small;
    }

    $limit = Limit::all()->first();
    $big = $limit->big;
    $small = $limit->small;
    $sold_out_big = $limit->sold_out_big;
    $sold_out_small = $limit->sold_out_small;
?>
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Activities'])
    <div class="container-fluid py-4">        
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Admin ACTIVITIES</h6>
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
                                            Excess Amount(Big)
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                            Excess Amount(Small)
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($beAnalysis as $ele)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="font-weight-bold mb-0"> {{ $ele->total_customer }} </p>                
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="font-weight-bold mb-0">{{  $ele->betno }}</p>
                                        </td>
                                        
                                        @if($ele->big > $sold_out_big)
                                        <td class="text-center align-middle text-danger">
                                            <p class="font-weight-bold mb-0">{{ $ele->big }}</p>
                                        </td>
                                        @else
                                        <td class="text-center align-middle">
                                            <p class="font-weight-bold mb-0">{{ $ele->big }}</p>
                                        </td>
                                        @endif
                                        
                                        @if($ele->small > $sold_out_small)
                                        <td class="align-middle text-center text-danger">                                    
                                            <p class="font-weight-bold mb-0">{{ $ele->small }}</p>
                                        </td>
                                        @else
                                        <td class="align-middle text-center">                                    
                                            <p class="font-weight-bold mb-0">{{ $ele->small }}</p>
                                        </td>
                                        @endif

                                        <td class="align-middle text-center">                                        
                                            <p class="font-weight-bold mb-0">{{ $ele->excess_big }}</p>
                                        </td>
                                        <td class="align-middle text-center">                                        
                                            <p class="font-weight-bold mb-0">{{ $ele->excess_small }}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                    <tr class="text-success">
                                        <td class="align-middle text-center">
                                            <p class="text-lg font-weight-bold mb-0"><strong>Total</p>                
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-lg font-weight-bold mb-0"></p>
                                        </td>
                                        <td class="text-center align-middle">
                                            <p class="text-lg font-weight-bold mb-0">{{ $total_big }}</p>
                                        </td>
                                        <td class="align-middle text-center">                                    
                                            <p class="text-lg font-weight-bold mb-0">{{ $total_small }}</p>
                                        </td>
                                        <td class="align-middle text-center">                                        
                                            <p class="text-lg font-weight-bold mb-0">{{ $total_big_excess }}</p>
                                        </td>
                                        <td class="align-middle text-center">                                        
                                            <p class="text-lg font-weight-bold mb-0">{{ $total_small_excess }}</p>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
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
                                            <p class="font-weight-bold mb-0">Set limit -Big</p>                
                                        </td>
                                       
                                        <td class="align-middle text-center">                                        
                                            <p class=" font-weight-bold mb-0">{{ $big }}</p>
                                        </td>
                                        <td class="align-middle text-center" style="border-collapse: collapse">
                                            {{-- <div class="ms-auto">                                          --}}
                                                <a class="btn btn-link text-dark px-3 mb-0 edit_btn"><i
                                                        class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                            {{-- </div> --}}
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class=" font-weight-bold mb-0">Set limit -Small</p>                
                                        </td>
                                       
                                        <td class="align-middle text-center">                                        
                                            <p class="font-weight-bold mb-0">{{ $small }}</p>
                                        </td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
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
                                            <p class="font-weight-bold mb-0">Sold out limit -Big</p>                
                                        </td>
                                       
                                        <td class="align-middle text-center">                                        
                                            <p class="font-weight-bold mb-0">{{ $sold_out_big }}</p>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="font-weight-bold mb-0">Sold out limit -Small</p>                
                                        </td>
                                       
                                        <td class="align-middle text-center">                                        
                                            <p class="font-weight-bold mb-0">{{ $sold_out_small }}</p>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.edit_btn').click(function(){
                
                if($(this).text().replace(/\s/g, '') == 'Edit')
                {
                    $(this).html('<a class="btn btn-link text-dark px-3 mb-0 edit_btn"><i class="fas fa-save text-dark me-2" aria-hidden="true"></i>Save</a>')
                    $(this).parent().siblings().eq(1).attr('contenteditable', true)
                }
                else{
                    $(this).html('<a class="btn btn-link text-dark px-3 mb-0 edit_btn"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>')
                    $(this).parent().siblings().eq(1).attr('contenteditable', false)

                    var val = $(this).parent().siblings().eq(1).text()
                    alert(val)

                    var type = 'small'
                    if($(this).parent().siblings().child('p').text() == "Set limit -Big")
                    {
                        type = 'big'
                    }

                    $.ajax({
                        type: 'POST',
                        url: '/setLimit',
                        data: {
                            'type': 'big',
                            'value': val
                        }
                    })  
                }
            })
        })
    </script>
@endsection
