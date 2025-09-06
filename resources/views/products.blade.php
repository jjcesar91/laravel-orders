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
<div class="main">
    <h4>Filtri</h4>
    <form action="/products" method="GET">
    <div class="row filters">
        <div class="col-sm-6 col-md-3">
            <div class="form-group row">
                <label for="inputPassword" class="col-3 col-form-label">Articoli</label>
                <div class="col-9">
                    <select name="agent" class="form-control">
                        <option value="" selected>TUTTI</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    </form>

    <table class="table" id="table_id">
        <thead>
        <tr>
            <th scope="col">SKU</th>
            <th scope="col">Descrizione</th>
            <th scope="col">ordini<br>da evadere</th>
            <th scope="col">qty<br>impegnata</th>
            <th scope="col">stock<br>magazzino</th>
            <th scope="col">qty<br>disponibile</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($skus as $sku)
                <tr>
                    <td>{{$sku}}</td>
                    <td>{{$products[$sku][0]->description}}</td>
                    <td>{{$products[$sku]->count()}}</td>
                    <td>{{$products[$sku]->sum('qty')}}</td>
                    <td>{{$products[$sku][0]->stock}}</td>
                    <td>{{$products[$sku][0]->stock-$products[$sku]->sum('qty')}}</td>
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