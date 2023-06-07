
@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Activities'])
    <div class="container-fluid py-4">        
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <span><strong>ADMIN ACTIVITIES</strong></span>  
                            <div class="dropdown d-inline-block float-end">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select company
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#">Magnum</a></li>
                                    <li><a class="dropdown-item" href="#">Damacai</a></li>
                                    <li><a class="dropdown-item" href="#">Toto</a></li>
                                    <li><a class="dropdown-item" href="#">G</a></li>
                                </ul>
                          </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
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
                                    @if (isset($beAnalysis))                                        
                                    @foreach($beAnalysis as $ele)
                                    <tr class="data" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <td class="align-middle text-center">
                                            <p class="font-weight-bold mb-0"> {{ $ele->total_customer }} </p>                
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="font-weight-bold mb-0">{{ $ele->betno }}</p>
                                        </td>
                                        
                                        @if($ele->big > $limit_sold_out_big)
                                        <td class="text-center align-middle text-danger">
                                            <p class="font-weight-bold mb-0">{{ $ele->big }}</p>
                                        </td>
                                        @else
                                        <td class="text-center align-middle">
                                            <p class="font-weight-bold mb-0">{{ $ele->big }}</p>
                                        </td>
                                        @endif
                                        
                                        @if($ele->small > $limit_sold_out_small)
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
                                    @endif
                                    
                                    <tr class="text-success">
                                        <td class="align-middle text-center">
                                            <p class="text-lg font-weight-bold mb-0"><strong>Total</p>                
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-lg font-weight-bold mb-0"></p>
                                        </td>
                                        <td class="text-center align-middle">
                                            @if(isset($total_big))
                                            <p class="text-lg font-weight-bold mb-0">{{ $total_big }}</p>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">  
                                            @if(isset($total_small))                                  
                                            <p class="text-lg font-weight-bold mb-0">{{ $total_small }}</p>
                                            @endif

                                        </td>
                                        <td class="align-middle text-center">  
                                            @if(isset($total_small))                                       
                                            <p class="text-lg font-weight-bold mb-0">{{ $total_big_excess }}</p>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center">   
                                            @if(isset($total_small))                                      
                                            <p class="text-lg font-weight-bold mb-0">{{ $total_small_excess }}</p>
                                            @endif
                                        </td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">  
                    <div class="card-header pb-0">
                        <h6><strong>OWNER ACCEPABLE LIMIT</strong></h6>
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
                                            @if(isset($total_small))                                        
                                            <p class=" font-weight-bold mb-0 value">{{ $limit_big }}</p>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center" style="border-collapse: collapse">
                                            <a class="btn btn-link text-dark px-3 mb-0 edit_btn">
                                                <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit
                                            </a>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class=" font-weight-bold mb-0">Set limit -Small</p>                
                                        </td>
                                       
                                        <td class="align-middle text-center">
                                            @if(isset($total_small))                                         
                                            <p class="font-weight-bold mb-0 value">{{ $limit_small }}</p>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center" style="border-collapse: collapse">
                                            <a class="btn btn-link text-dark px-3 mb-0 edit_btn"><i
                                                class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                        </td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="font-family: var(--bs-body-font-family);">
                <div class="card mb-4">  
                    <div class="card-header pb-0">
                        <h6><strong>BETTING LIMIT</strong></h6>
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
                                            @if(isset($total_small))                                  
                                            <p class="font-weight-bold mb-0 value">{{ $limit_sold_out_big }}</p>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center" style="border-collapse: collapse">
                                            <a class="btn btn-link text-dark px-3 mb-0 edit_btn"><i
                                                    class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="font-weight-bold mb-0">Sold out limit -Small</p>                
                                        </td>                                       
                                        <td class="align-middle text-center"> 
                                            @if(isset($total_small))                                        
                                            <p class="font-weight-bold mb-0 value">{{ $limit_sold_out_small }}</p>
                                            @endif
                                        </td>
                                        <td class="align-middle text-center" style="border-collapse: collapse">
                                            <a class="btn btn-link text-dark px-3 mb-0 edit_btn"><i
                                                class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                                        </td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <!-- Modal -->
    <div class="modal fade pr-5 mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header display-block">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Details</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body" style="overflow-x: auto">
                    <table id="detailedTable" class="table align-items-center justify-content-center mb-0 admin_activities_1">
                        <thead>
                            <tr>
                                <th 
                                    class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                    Customer
                                </th>
                                <th
                                    class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                    Betting No.
                                </th>
                                <th
                                    class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                    Big
                                </th>
                                <th
                                    class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                    Small
                                </th>
                                <th
                                    class="text-uppercase text-secondary text-md font-weight-bolder text-center opacity-7 ps-2">
                                    Date
                                </th>
                            </tr>
                        </thead>
                    </table> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth.footer')
    
    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            @if (isset($company))
                @if ($company == 'm')
                    $('#dropdownMenuButton').text('Magnum')
                @elseif ($company == 'd')
                    $('#dropdownMenuButton').text('Damacai')
                @elseif ($company == 't')
                    $('#dropdownMenuButton').text('Toto')
                @else
                    $('#dropdownMenuButton').text('G')
                @endif
            @endif

            $('.edit_btn').click(function(){
                
                if($(this).text().replace(/\s/g, '') == 'Edit')
                {
                    $(this).html('<a class="btn btn-link text-dark px-3 mb-0 edit_btn"><i class="fas fa-save text-dark me-2" aria-hidden="true"></i>Save</a>')
                    $(this).parent().siblings().eq(1).children('p').attr('contenteditable', true)
                    $(this).parent().siblings().eq(1).children('p').focus()
                }
                else{
                    $(this).html('<a class="btn btn-link text-dark px-3 mb-0 edit_btn"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>')
                    $(this).parent().siblings().eq(1).attr('contenteditable', false)

                    var val = $(this).parent().siblings().eq(1).children('p').text()

                    var type = ''
                    var text = $(this).parent().siblings().eq(0).children('p').text()

                    switch (text) {
                        case "Set limit -Big":
                            type = 'big'
                            break;
                        case "Set limit -Small":
                            type = 'small'
                            break;
                        case "Sold out limit -Big":
                            type = 'sold_out_big'
                            break;
                        case "Sold out limit -Small":
                            type = 'sold_out_small'
                            break;
                        
                        default:
                            break;
                    }   
                    
                    $.ajax({
                        type: 'POST',
                        url: '/setLimit',
                        data: {
                            'type': type,
                            'value': val
                        },
                        headers: {'x-csrf-token': '{{ csrf_token() }}'},
                        success:function(data){
                            console.log(data)
                            window.location.reload()
                        }
                    })  
                }
            })

            $('.data').click(function() {
                // Getting the ticket number of this row
                bettingno = $(this).children().eq(1).text().replace(/\s/g, '')
                
                btnText = $('#dropdownMenuButton').text()
                company = btnText.substr(0, 1)
                
                $.ajax({
                        type: 'GET',
                        url: '/getDetails/' + bettingno + '/' + company,
                        headers: {'x-csrf-token': '{{ csrf_token() }}'},
                        
                        beforeSend: function () {
                        
                        },

                        success:function(data) {

                            $('#detailedTable tr.new').remove()

                            result = data.history
                            
                            result.forEach(one => {
                                customer = one.phoneNumber
                                bettingno = one.number
                                big = one.big
                                small = one.small
                                date = one.created_at.substr(0, 10)

                                $('#detailedTable').append("<tr class='new'><td class='align-middle text-center'><p class='font-weight-bold mb-0'>" + customer + "</p></td>"
                                                             + "<td class='align-middle text-center'><p class='font-weight-bold mb-0'>" + bettingno + "</p></td>"                      
                                                             + "<td class='text-center align-middle'><p class='font-weight-bold mb-0'>" + big + "</p></td>"
                                                             + "<td class='align-middle text-center'><p class='font-weight-bold mb-0'>" + small + "</p></td>"
                                                             + "<td class='align-middle text-center'><p class='font-weight-bold mb-0'>" + date + "</p></td></tr>" )
                            });

                        },
                        
                        error: function (xhr, err) { 

                        }
                    })
            })

            $('.dropdown-item').click(function () {
                company = $(this).text()

                switch(company)
                {
                    case 'Magnum':
                        location.href = "{{ route('page', ['page' => 'm']) }}"
                        break

                    case 'Damacai':
                        location.href = "{{ route('page', ['page' => 'd']) }}"
                        break

                    case 'Toto':
                        location.href = "{{ route('page', ['page' => 't']) }}"
                        break

                    case 'G':
                        location.href = "{{ route('page', ['page' => 's']) }}"
                        break
                }
            })
        })
    </script>
@endsection
