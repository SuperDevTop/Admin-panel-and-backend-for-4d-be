<?php
    use App\Models\User;

    $users = User::all();
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
                                    </tr>
                                    @endforeach
                                    
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
