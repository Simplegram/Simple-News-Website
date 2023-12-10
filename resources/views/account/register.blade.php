@extends('template.master')
@section('title', 'Register')
@section('content')
<link rel="stylesheet" href="/css/account.css">
<div class="background">
    <div class="center">
        <h1>Register Page</h1>
        <form action="/register" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="txt">
                <input type="text" id="username" name="username" required/>
                <span></span>
                <label for="username" class="username">Username</label>
            </div>
            <div class="txt">
                <input type="text" id="email" name="email" required/>
                <span></span>
                <label for="email" class="email">Email</label>
            </div>
            <div class="txt">
                <input class="password" type="password" id="password" name="password" required/>
                <span></span>
                <label for="password" class="pass">Password</label>
            </div>
            <div class="txt">
                <input class="confirm" type="password" id="confirmpassword" name="confirmpassword" required/>
                <span></span>
                <label for="confirm" class="conf">Confirm Password</label>
            </div>
            <input id="terms" type="checkbox" required/>
            <label for="terms">I agree with the terms and conditions</label>
            <input type="submit" value="Register"/>
            <div class="regist">
                Already have an account? <a href="/login">login</a>
            </div>
        </form>
    </div>
</div>
@endsection
