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
                    <span class="font-weight-bolder font-size-sm"><h4>N. Ordini</h4></span>
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
                    <span class="font-weight-bolder font-size-sm"><h4>Prezzo totale</h4></span>
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
                    <span class="font-weight-bolder font-size-sm"><h4>Ordini 100%</h4></span>
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
                    <span class="font-weight-bolder font-size-sm"><h4>Ordini completati</h4></span>
                    <span class="font-weight-bolder font-size-h5">
                    <span class="text-dark-50 font-weight-bold"></span><h5>{{$done_orders}}</h5></span>
                </div>
            </div>
        </div>
    </div>

    
</div>
<div class="main">
<h4>Filtri</h4>
<form action="/orders" method="GET">
<div class="row filters">
    <div class="col-sm-6 col-md-3">
        <div class="form-group row">
            <label for="inputPassword" class="col-3 col-form-label">Agente</label>
            <div class="col-9">
                <select name="agent" class="form-control">
                    <option value="" selected>TUTTI</option>
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
            <label for="inputPassword" class="col-3 col-form-label">Cliente</label>
            <div class="col-9">
                <select name="customer" class="form-control">
                    <option value="" selected>TUTTI</option>
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
            <label for="inputPassword" class="col-3 col-form-label">Stato</label>
            <div class="col-9">
                <select name="status" class="form-control">
                    <option value="">TUTTI</option>
                    <option @if(isset($filter['status']) && $filter['status'] == "0") selected  @endif
                    value="0">APERTO</option>
                    <option @if(isset($filter['status']) && $filter['status'] == "1") selected  @endif
                    value="1">PARZIALE</option>
                    <option @if(isset($filter['status']) && $filter['status'] == "2") selected  @endif
                    value="2">COMPLETATO</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row filters">
    <div class="col-sm-6 col-md-3">
        <div class="form-group row">
            <label for="inputPassword" class="col-3 col-form-label">Prezzo</label>
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
        <button class="btn btn-primary">Filtra</button>
        <a href="/orders" class="btn btn-danger">Reset</a>
    </div>

</div>

</form>
<table class="table" id="table_id">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Data ordine</th>
        <th scope="col">Stato<br>Gestionale</th>
        <th scope="col">Agente</th>
        <th scope="col">Cliente</th>
        <th scope="col">Destinazione</th>
        <th scope="col">Prezzo</th>
        <th scope="col">% Stock</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <th scope="row">{{ $order->id }}</th>
                <td>{{ $order->registered_at }}</td>
                <td>
                    @switch($order->status)
                        @case(0)
                            APERTO
                            @break
                        @case(1)
                            PARZIALE
                            @break
                        @case(2)
                            COMPLETATO
                            @break
                        @default
                            -
                    @endswitch
                </td>
                <td>
                    @if(Illuminate\Support\Arr::exists($agents,$order->agent_id))
                        {{ $agents[$order->agent_id]->name }}
                    @else
                        {{$order->agent_info}} 
                    @endif
                </td>
                <td>
                    @if($order->customer_code == '11')
                        AGG
                    @elseif(Illuminate\Support\Arr::exists($customers,$order->customer_code))
                        {{ $customers[$order->customer_code]->name }}
                    @else
                        {{$order->customer_info}} 
                    @endif
                </td>
                <td>
                    
                    @if(Illuminate\Support\Arr::exists($customers,$order->customer_code))
                        {{ $customers[$order->customer_code]->city }}
                    @else
                        N/A  
                    @endif

                </td>
                <td>{{ $order->final_price }} €</td>
                <td>
                    <div class="progress" style="height: 20px">
                        @if ($order->perc_complete == 100)
                            <div class="progress-bar " 
                            style="color:white !important;background-color:green;width: {{$order->perc_complete}}%;" 
                            role="progressbar"aria-valuenow="{{$order->perc_complete}}" 
                            aria-valuemin="0" aria-valuemax="100">
                                {{$order->perc_complete}}%
                            </div>
                        @elseif ($order->perc_complete < 30)
                            <div class="progress-bar " 
                            style="color:white !important;background-color:red;" 
                            role="progressbar" aria-valuenow="{{$order->perc_complete}}" 
                            aria-valuemin="0" aria-valuemax="100">
                                {{$order->perc_complete}}%
                            </div>
                        @else
                            <div class="progress-bar " 
                            style="color:white !important;background-color:orange;width: {{$order->perc_complete}}%;" 
                            role="progressbar" aria-valuenow="{{$order->perc_complete}}" 
                            aria-valuemin="0" aria-valuemax="100">
                                {{$order->perc_complete}}%
                            </div>
                        @endif
                        
                    </div>
                </td>
                <td>
                    <a href="order/{{$order->id}}">
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