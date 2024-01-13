@extends('layouts.app')

@section('title', 'News List')

@section('breaking-news')
<link rel="stylesheet" href="{{ asset('css/news.css') }}">
<div class="breaking-container">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center breaking-news bg-white">
                <marquee class="news-scroll" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                @php($i = 0)
                @foreach ($headline['articles'] as $news)
                    @if($i == 5) @break
                    @endif
                    |
                    <a href={{ $news['url'] }}>{{ $news['title'] }}</a>
                    @php($i++)
                @endforeach
                </marquee>
            </div>
        </div>
    </div>
</div>

@section('content')
<link rel="stylesheet" href="{{ asset('css/news.css') }}">
    @dump($weather)
    <div class="weather-container m-2 w-100">
        <h1>Weather</h1>
        <div class="weather-card m-2">
            <div class="weather-inside">
                <div class="title">
                    <h1>{{ $weather['location']['name'] }}, {{ $weather['location']['region'] }}</h1>
                    <div class="condition">
                        <img src="{{ $weather['current']['condition']['icon'] }}">
                        {{ $weather['current']['condition']['text'] }}
                    </div>
                </div>
                <div class="info">
                    <div class="temp">
                        <div>
                            <h1>{{ $weather['current']['temp_c'] }}</h1>
                            <p>&deg;C</p>
                        </div>
                        <div>
                            <p>Feels Like {{ $weather['current']['feelslike_c'] }}</p>
                            <p>&deg;</p>
                        </div>
                    </div>
                    <div class="index">

                    </div>
                </div>
                <div class="update">

                </div>
            </div>
        </div>
    </div>
    <div class="news-container m-2 w-100">
        <h1>News</h1>
        <div class="news-card row m-2">
            @php($i = 0)
            @foreach ($newsData['articles'] as $news)
                @if($i == 10) @break
                @endif
                <div class="card mb-5">
                    <div class="card-header">
                        <img src="{{ $news['urlToImage'] }}" alt="">
                        <a href={{ $news['url'] }}>{{ $news['title'] }}</a>
                    </div>
                    <div class="card-body">
                        {{ $news['description'] }}
                        <a href={{ $news['url'] }}>Read More</a>
                    </div>
                </div>
                @php($i++)
            @endforeach
        </div>
    </div>

@endsection
