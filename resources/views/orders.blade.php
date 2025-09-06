@extends('layout.base')

@section('head')
<style>
    .header{
        border-bottom: solid 1px #ccc;
        padding:20px;
        margin-bottom: 50px
    }

    .header .r-btn{
        float: right;
        font-size:35px;
        color: #999 !important;
        margin-right:30px;
        cursor:pointer;
    }

    .header .r-btn a{
        color: #999 !important; 
    }

    a{
        text-decoration: none;
    }

    .filters{
        margin: 0px;
        padding: 20px;
        color:#555;
    }

    .main{
        padding-left:30px;
        padding-right:30px;
    }

    body {
        font-family: Roboto, Arial, Helvetica, sans-serif;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
@endsection

@section('content')


<div class="row filters mb-4">
    <div class="col-sm-6 col-md-3 mb-4">

        <div class="card card-custom bg-light gutter-b">
            <div class="card-body">
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm"><h4>No. Orders</h4></span>
                    <span class="font-weight-bolder font-size-h5">
                    <span class="text-dark-50 font-weight-bold"></span><h5> {{$count}}</h5></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3 mb-4">

        <div class="card card-custom bg-light gutter-b">
            <div class="card-body">
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm"><h4>Total Price</h4></span>
                    <span class="font-weight-bolder font-size-h5">
                    <span class="text-dark-50 font-weight-bold"></span><h5>€ {{number_format($totprice,2)}}</h5></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3 mb-4">

        <div class="card card-custom bg-light gutter-b">
            <div class="card-body">
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm"><h4>100% Orders</h4></span>
                    <span class="font-weight-bolder font-size-h5">
                    <span class="text-dark-50 font-weight-bold"></span><h5>{{$av_orders}}</h5></span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3 mb-4">

        <div class="card card-custom bg-light gutter-b">
            <div class="card-body">
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm"><h4>Completed Orders</h4></span>
                    <span class="font-weight-bolder font-size-h5">
                    <span class="text-dark-50 font-weight-bold"></span><h5>{{$done_orders}}</h5></span>
                </div>
            </div>
        </div>
    </div>

    
</div>
<div class="main">
<h4>Filters</h4>
<form action="/orders" method="GET">
<div class="row filters">
    <div class="col-sm-6 col-md-3">
        <div class="form-group row">
            <label for="inputPassword" class="col-3 col-form-label">Agent</label>
            <div class="col-9">
                <select name="agent" class="form-control">
                    <option value="" selected>ALL</option>
                    @foreach ($agents as $agent)
                        <option value="{{ $agent->id }}"
                            @if(isset($filter['agent']) && $filter['agent'] == $agent->id) selected  @endif
                        >{{ $agent->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group row">
            <label for="inputPassword" class="col-3 col-form-label">Customer</label>
            <div class="col-9">
                <select name="customer" class="form-control">
                    <option value="" selected>ALL</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->code }}"
                            @if(isset($filter['customer']) && $filter['customer'] == $customer->code) selected  @endif
                        >{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group row">
            <label for="inputPassword" class="col-3 col-form-label">Status</label>
            <div class="col-9">
                <select name="status" class="form-control">
                    <option value="">ALL</option>
                    <option @if(isset($filter['status']) && $filter['status'] == "0") selected  @endif
                    value="0">OPEN</option>
                    <option @if(isset($filter['status']) && $filter['status'] == "1") selected  @endif
                    value="1">PARTIAL</option>
                    <option @if(isset($filter['status']) && $filter['status'] == "2") selected  @endif
                    value="2">COMPLETED</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row filters">
    <div class="col-sm-6 col-md-3">
        <div class="form-group row">
            <label for="inputPassword" class="col-3 col-form-label">Price</label>
            <div class="col-4">
                <input type="text" name="min-price" 
                @if(isset($filter['min-price'])) value="{{$filter['min-price']}}"  @endif
                class="form-control" placeholder="min">
            </div>
            <div class="col-4">
                <input type="text" name="max-price" 
                @if(isset($filter['max-price'])) value="{{$filter['max-price']}}"  @endif
                class="form-control" placeholder="max">
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="form-group row">
            <label for="inputPassword" class="col-3 col-form-label">Stock %</label>
            <div class="col-4">
                <input type="text" name="min-perc" 
                @if(isset($filter['min-perc'])) value="{{$filter['min-perc']}}"  @endif
                class="form-control" placeholder="min">
            </div>
            <div class="col-4">
                <input type="text" name="max-perc" 
                @if(isset($filter['max-perc'])) value="{{$filter['max-perc']}}"  @endif
                class="form-control" placeholder="max">
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
    <button class="btn btn-primary">Filter</button>
    <a href="/orders" class="btn btn-danger">Reset</a>
    </div>

</div>

</form>
<table class="table" id="table_id">
    <thead>
      <tr>
        <th scope="col">#</th>
    <th scope="col">Order Date</th>
    <th scope="col">Status</th>
    <th scope="col">Agent</th>
    <th scope="col">Customer</th>
    <th scope="col">Destination</th>
    <th scope="col">Price</th>
    <th scope="col">% Stock</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <th scope="row">{{ $order['id'] }}</th>
                <td>-</td>
                <td>
                    @if($order['status'] === 'in lavorazione')
                        IN PROGRESS
                    @elseif($order['status'] === 'completato')
                        COMPLETED
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if(isset($agents[$order['agent_id']]))
                        {{ $agents[$order['agent_id']]['name'] }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if(isset($customers[$order['customer_id']]))
                        {{ $customers[$order['customer_id']]['name'] }}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if(isset($customers[$order['customer_id']]) && isset($customers[$order['customer_id']]['city']))
                        {{ $customers[$order['customer_id']]['city'] }}
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $order['total'] }} €</td>
                <td>
                    <div class="progress" style="height: 20px">
                        <div class="progress-bar " style="color:white !important;background-color:orange;width: 100%;" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
                    </div>
                </td>
                <td>
                    <a href="order/{{$order['id']}}">
                        <i style="cursor:pointer" class="fa-solid fa-magnifying-glass"></i>
                    </a>
                </td>
            </tr>
        @endforeach
      
    </tbody>
  </table>
</div>
<script>
$(document).ready( function () {
    $('#table_id').DataTable({
        responsive: true
    });
} );

</script>
@endsection