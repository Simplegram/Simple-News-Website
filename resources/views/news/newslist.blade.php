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
    <div class="weather-container m-2 w-100">
        <h1>Weather</h1>
        <div class="weather-card m-2">
            <div class="weather-inside">
                <div class="title">
                    <h1>{{ $weather['location']['name'] }}, {{ $weather['location']['region'] }}</h1>
                    <div class="condition">
                        <img src="{{ $weather['current']['condition']['icon'] }}">
                        <p>{{ $weather['current']['condition']['text'] }}</p>
                    </div>
                </div>
                <div class="info">
                    <div class="temp">
                        <div class="current">
                            <h1 id="temp_c">{{ $weather['current']['temp_c'] }}</h1>
                            <h1 id="deg">&deg;C</h1>
                        </div>
                        <p>Feels like {{ $weather['current']['feelslike_c'] }}&deg;C</p>
                    </div>
                    <div class="index">
                        <h1 style="font-size: large; font-weight: bold; letter-spacing: 4px">Pollution Index</h1>
                        @if($weather['current']['air_quality']['gb-defra-index'] <= 3)
                        <div class="defra-idx" style="background-color: #00FF38">
                            <h1>Low</h1>
                            <h1>{{ $weather['current']['air_quality']['gb-defra-index'] }}</h1>
                        </div>
                        <p>Beraktivitas seperti biasa.</p>
                        @elseif($weather['current']['air_quality']['gb-defra-index'] <= 6)
                        <div class="defra-idx" style="background-color: #FFA800">
                            <h1>Moderate</h1>
                            {{ $weather['current']['air_quality']['gb-defra-index'] }}
                        </div>
                        <p>Beraktivitas seperti biasa. Bagi yang mengidap masalah paru-paru, masalah jantung, kurangi aktivitas di luar ruangan.</p>
                        @elseif($weather['current']['air_quality']['gb-defra-index'] <= 9)
                        <div class="defra-idx" style="background-color: #FF0000">
                            <h1>High</h1>
                            {{ $weather['current']['air_quality']['gb-defra-index'] }}
                        </div>
                        <p>Disarankan untuk mengurangi aktivitas di luar ruangan jika mata perih, batuk, atau radang. Gunakan masker untuk mencegah penghirupan partikulat udara besar.</p>
                        @elseif($weather['current']['air_quality']['gb-defra-index'] <= 10)
                        <div class="defra-idx" style="background-color: #BD00FF">
                            <h1>Very High</h1>
                            {{ $weather['current']['air_quality']['gb-defra-index'] }}
                        </div>
                        <p>Diharuskan untuk mengurangi aktivitas yang di luar ruangan jika batuk atau radang. Gunakan masker untuk mencegah penghirupan partikulat udara besar.</p>
                        @endif
                        <div class="graph">
                            <p class="rating" style="background-color: #00FF38">1-3</p>
                            <p class="rating" style="background-color: #FFA800">4-6</p>
                            <p class="rating" style="background-color: #FF0000">7-9</p>
                            <p class="rating" style="background-color: #BD00FF">10</p>
                        </div>
                    </div>
                </div>
                <div class="update">
                    <div></div>
                    <div class="time">
                        <h1>Updated At</h1>
                        <p>{{ $weather['current']['last_updated'] }}</p>
                    </div>
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
                        <p>{{ $news['description'] }}</p>
                        <a href={{ $news['url'] }}>Read More</a>
                    </div>
                    @if($news['url'])
                    <form method="POST" action="{{ route('addReadLater') }}">
                        @csrf
                        <input type="hidden" name="imgUrl" value="{{ $news['urlToImage'] }}">
                        <input type="hidden" name="url" value="{{ $news['url'] }}">
                        <input type="hidden" name="title" value="{{ $news['title'] }}">
                        <input type="hidden" name="desc" value="{{ $news['description'] }}">
                        <button type="submit" href="">Read Later</button>
                    </form>
                    @else
                    <button>Saved</button>
                    @endif
                </div>
                @php($i++)
            @endforeach
        </div>
    </div>

@endsection
