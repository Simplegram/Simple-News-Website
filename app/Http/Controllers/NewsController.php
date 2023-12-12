<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    public function getTopHeadlines()
    {
        $apiKey = 'c5477f93c91c4229aaff8b842268f3cf';
        $url = 'https://newsapi.org/v2/top-headlines?country=id&apiKey=' . $apiKey;

        $response = Http::get($url);

        if ($response->successful()) {
            $newsData = $response->json();
            return view('news.newslist', ['newsData' => $newsData]);
        } else {
            return view('news.error');
        }
    }
}
