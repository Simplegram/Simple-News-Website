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
    <div class="news-container m-2">
        <h1>News</h1>
        <div class="news-card row m-2">
            @php($i = 0)
            @foreach ($newsData['articles'] as $news)
                @if($i == 10) @break
                @endif
                <div class="card mb-5">
                    <div class="card-header">
                        <img src={{ $news['urlToImage'] }} alt={{ $news['title'] }}>
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
