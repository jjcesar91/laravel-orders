@extends('layout.base')

@section('head')
<style>
    body {
        font-family: Roboto, Arial, Helvetica, sans-serif;
        display:flex; flex-direction:column; justify-content:center;
        min-height:100vh;
    }
    form {
        border: 3px solid #f1f1f1;
        text-align: center;
    }
    
    input[type=text], input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    
    button {
      background-color: #04AA6D;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }
    
    button:hover {
      opacity: 0.8;
    }
    
    .btn-submit{
        text-transform: uppercase;
        background-color:royalblue;
        margin-top:40px;
    }
    
    .btn-submit:hover{
        letter-spacing: 3px;
    }
    
    .cancelbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }
    
    .imgcontainer {
      text-align: center;
      margin: 24px 0 12px 0;
    }
    
    img.avatar {
      width: 40%;
      border-radius: 50%;
    }
    
    .container {
      padding: 16px;
      max-width:500px;
      margin: 0 auto;
    }
    
    .subtitle{
        text-transform: uppercase;
        letter-spacing: 10px;
        margin-bottom:40px;
    }
    
    span.psw {
      float: right;
      padding-top: 16px;
    }

    .header{
        display:none !important;
      }
    
    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
      span.psw {
         display: block;
         float: none;
      }
      .cancelbtn {
         width: 100%;
      }
    }
    </style>
@endsection

@section('content')
@if (session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif
<form id="signin" class="form-horizontal validate-form" method="POST" action="{{ route('process.login') }}">
    {{ csrf_field() }}
    <div class="imgcontainer">
      <img src="Logo.jpg" width="200" alt="Logo" >
      <p class="subtitle"><b>Management</b> system</p>
    </div>
      <div class="container">
          <label for="uname" ><b>EMAIL</b></label>
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off">
            @error('email')
            <div class="error-txt">{{ $message }}</div>
            @enderror

          <label for="psw" ><b>PASSWORD</b></label>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off">
            @error('password')
            <div class="error-txt">{{ $message }}</div>
            @enderror
              
          <button type="submit" class="btn-submit">LOGIN</button>
          <label>
          <input type="checkbox" checked="checked" name="remember"> Remember me
          </label>
      </div>
  
    <div class="container" style="margin-bottom:40px">
      <span class="psw">Forgot your <a href="#">password?</a></span>
    </div>
  </form>
  @endsection