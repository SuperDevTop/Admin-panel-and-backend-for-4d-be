<?php
    use App\Models\User;

    $users = User::all();
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
                                    @foreach($users as $user)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0"> {{$user->phoneNumber}} </p>                
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">0</p>
                                        </td>
                                        <td class="text-center align-middle">
                                            <p class="text-sm font-weight-bold mb-0">50</p>
                                        </td>
                                        <td class="align-middle text-center">                                    
                                            <p class="text-sm font-weight-bold mb-0">{{rand() % 5 * 10}}</p>
                                        </td>
                                        <td class="align-middle text-center">                                        
                                            <p class="text-sm font-weight-bold mb-0">{{rand() % 5 * 5}}</p>
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
