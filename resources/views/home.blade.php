@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if ($user['name'])
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                        <!-- <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div> -->

                    {{ __('You are logged in as') }}
                    {{ $user['name'] }}
                    <a href="/news">Show News</a>
                </div>
            </div>
        </div>
        @else
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome to TechNews') }}</div>
                <div class="card-body">
                    {{ __('You can browse news as guest or saved news by registering an account') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
