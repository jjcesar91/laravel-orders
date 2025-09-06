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

    <div class="col-md-4 col-sm-12 mb-4">

        <div class="card card-custom bg-light gutter-b">
            <div class="card-body">
                <div class="d-flex flex-column text-dark-75">
                    <span class="text-dark-50 font-weight-bold"></span><h6>{{$order->created_at}}</h6></span>
                    <span class="font-weight-bolder font-size-sm"><h5>@if($cliente) {{$cliente->name}} @else {{$order->customer_info}} @endif</h5></span>
                    <span class="font-weight-bolder font-size-h5">
                    <span class="text-dark-50 font-weight-bold"></span><h6>@if($cliente) {{$cliente->address}} @endif</h6></span>
                    <span class="text-dark-50 font-weight-bold"></span><h6>@if($cliente) {{$cliente->city}} {{$cliente->zipcode}} {{$cliente->province}} @endif</h6></span>
                    <br>
                    <span class="text-dark-50 font-weight-bold"></span>Agente: <h6>@if($agent) {{$agent->name}} @else {{$order->agent_info}} @endif</h6></span>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
    </div>
    <div class="col-md-4 col-sm-12 mb-4">
        <div class="card card-custom bg-light gutter-b">
            <div class="card-body">
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm"><h3>
                        @switch($order->status)
                            @case(0)
                                OPEN
                                @break
                            @case(1)
                                PARTIAL
                                @break
                            @case(2)
                                COMPLETED
                                @break
                            @default
                                -
                        @endswitch
                    </h3></span>
                    @if($order->status == 1)
                        <span class="font-weight-bolder font-size-sm"><h6>Amount to pay</h6></span>
                        <span class="text-dark-50 font-weight-bold"></span><h5>€ {{number_format($topay_price, 2)}}</font>  <small>of € {{number_format($order->final_price, 2)}} </small></h5></span>
                    @endif
                    <span class="font-weight-bolder font-size-sm"><h6>Invoiceable amount</h6></span>
                    <span class="text-dark-50 font-weight-bold"></span><h5 >
                        @if ($order->perc_complete == 100)
                        <font style="color:green">
                        @elseif ($order->perc_complete < 30)
                        <font style="color:red">
                        @else
                        <font style="color:orange">
                        @endif
                        
                        € {{number_format($available_price, 2)}}</font>  <small>of € {{number_format($order->final_price, 2)}} </small></h5></span>
                    <span class="text-dark-50 font-weight-bold" >
                        <div class="progress">
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
                    </span><br>
                    <span class="text-dark-50 font-weight-bold"></span>Payment: <h6>{{$order->pay_info}} </h6></span>
                    <span class="text-dark-50 font-weight-bold"></span>Notes: <h6>{{$order->notes}} </h6></span>
                </div>
            </div>
        </div>
    </div>

    
</div>
<div class="main">
<h4>Filters</h4>

<table class="table" id="table_id">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">SKU</th>
        <th scope="col">Description</th>
        <th scope="col">Qty</th>
        <th scope="col">Unit Price</th>
        <th scope="col">Total Price</th>
        <th scope="col">Current<br>Stock</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($details as $detail)
            <tr>
                <td>{{$detail->order_row}}</td>
                <td>{{$detail->sku}}</td>
                <td>{{$detail->description}}</td>
                <td>{{$detail->qty}}</td>
                <td>€ {{number_format($detail->price_unit,2)}}</td>
                <td>€ {{number_format($detail->price_tot, 2)}}</td>
                <td>{{$detail->stock}}</td>
                <td>
                    @switch($detail->status)
                        @case(0)
                            NOT PROCESSED
                            @break
                        @case(1)
                            NOT PROCESSED
                            @break
                        @case(2)
                            NOT PROCESSED
                            @break
                        @case(3)
                            NOT PROCESSED
                            @break
                        @case(4)
                            IN PREPARATION
                            @break
                        @case(5)
                            SHIPPED
                            @break
                        @case(6)
                            INVOICED
                            @break
                        @default
                            -
                    @endswitch
                
                
                
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