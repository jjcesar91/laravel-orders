<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/0f4d0540d3.js" crossorigin="anonymous"></script>
@yield('head')
<style>
.header .l-btn{
        display: inline;
        font-size:25px;
        color: #999 !important;
        cursor:pointer;
        margin-left:30px;

        
    }
</style>
</head>
<body>
    <div class="header">
        <img height="60" src="/Logo.jpg">
        <div style="height:60px"class="l-btn" >
            <a style="line-height:60px; text-decoration: none; color: #999 !important;" href="/orders">
                Ordini
            </a>
        </div>
        <div style="height:60px"class="l-btn" >
            <a style="line-height:60px; text-decoration: none; color: #999 !important;" href="/products">
                Articoli
            </a>
        </div>
        <div style="height:60px" class="r-btn">
            <a style="line-height:60px" href="login">
                <i class="fa-solid fa-power-off"></i>
            </a>
        </div>
    </div>
    @yield('content')


</body>
</html>
