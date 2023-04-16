<?php
    use App\Models\User;

    $users = User::all();
?>
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Points Movement'])
    <div class="container-fluid py-4">        
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>POINTS</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Customer List</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Point Balance</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Reload</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Spent</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                            Points Available
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2">
                                                <div>
                                                    <img src="/img/small-logos/logo-spotify.svg"
                                                        class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                                                </div>
                                                <div class="my-auto">
                                                    <h6 class="mb-0 text-sm"> {{ $user->phoneNumber }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->pointbalance }}</p>
                                        </td>
                                        <td class="text-center align-middle">
                                            <p class="reload text-sm font-weight-bold mb-0">{{ $user->reload }}</p>
                                        </td>
                                        <td class="align-middle text-center">                                           
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->spent }}</p>
                                        </td>
                                        <td class="align-middle text-center">                                           
                                            <p class="ptavailable text-sm font-weight-bold mb-0">{{ $user->pointsavailable }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <button class="btn btn-danger btn-link text-white mb-0 add-point"><i class="fa fa-plus"></i> Add</button>
                                        </td>
                                        <td class="lastrow">
                                            <input size="5" class="point"><button class="save">save</button><button class="cancel">cancel</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
         $(document).ready(function(){
            $('.lastrow').hide()
            
            $('.add-point').click(function(){
                $(this).parent().siblings('.lastrow').show()
            })

            $('.cancel').click(function(){
                $(this).parent().hide()
            })

            $('.save').click(function(){
                var point = $(this).siblings('.point').val()
                var phoneNumber = $(this).parent().siblings().first('div div h6').text().trim()
                var the = $(this)

                $.ajax({
                        type: 'POST',
                        url: '/addPoint',
                        data: {
                            'point': point,
                            'phoneNumber': phoneNumber
                        },
                        headers: {'x-csrf-token': '{{ csrf_token() }}'},
                        success:function(data){
                            if (data.msg == 'success') {
                                reload = data.reload
                                pointsavailable = data.pointsavailable

                                the.parent().siblings().eq(2).children().text(reload)
                                the.parent().siblings().eq(4).children().text(pointsavailable)
                                $('.lastrow').hide()
                            }
                        }
                    })
            })
         })
    </script>
@endsection
