@extends('template.master')

@section('title', 'News List')

@section('content')
    <h1>Top Headlines</h1>

    <div class="row">
        @if(isset($newsData['articles']))
            @foreach($newsData['articles'] as $article)
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 18rem;">
                        @if(isset($article['urlToImage']))
                            <img class="card-img-top" src="{{ $article['urlToImage'] }}" alt="Card image cap">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $article['title'] }}</h5>
                            <p class="card-text">{{ $article['description'] }}</p>
                            <a href="{{ $article['url'] }}" class="btn btn-primary" target="_blank">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No news available.</p>
        @endif
    </div>
@endsection
