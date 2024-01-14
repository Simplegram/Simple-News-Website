@extends('layouts.app')

@section('title', 'Saved News')

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
    <div class="news-container m-2 w-100">
        <h1>Saved News</h1>
        <div class="news-card row m-2">
            @php($i = 0)
            @forelse ($savedNews as $news)
                <div class="card mb-5">
                    <div class="card-header">
                        <img src="{{ $news['imgUrl'] }}" alt="">
                        <a href={{ $news['url'] }}>{{ $news['title'] }}</a>
                    </div>
                    <div class="card-body">
                        <p>{{ $news['description'] }}</p>
                        <a href={{ $news['url'] }}>Read More</a>
                    </div>
                    <form method="POST" action="{{ route('deleteSaved') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $news['id'] }}">
                        <button type="submit">Remove News</button>
                    </form>
                </div>
            @empty
            <h2 style="font-size: 20px">No saved news</h2>
            @endforelse
        </div>
    </div>
@endsection