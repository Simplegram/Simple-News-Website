<?php

namespace App\Http\Controllers;

use App\Http\Controllers\NewsController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Articles;

class NewsController extends Controller
{
    private $users;

    public function __construct()
    {
        $this->users = new User();
    }

    public function addReadLater(Request $request){
        $value = Auth::id();
        $user = $this->users->find($value);

        $articles = new Articles;
        $articles->userId = $user->id;
        $articles->imgUrl = $request->input('imgUrl');
        $articles->url = $request->input('url');
        $articles->title = $request->input('title');
        $articles->description = $request->input('desc');
        $articles->save();

        return load($request);
    }

    public function loadSavedNews(Request $request){
        $value = Auth::id();
        $user = $this->users->find($value);
        
        $headline = $this->loadHeadlineJSON($request);
        $articles = Articles::all();

        return view('news.newslater', ['savedNews' => $articles, 'headline' => $headline]);
    }

    public function returnView(Request $request, $newsData){
        $value = Auth::id();
        $user = $this->users->find($value);
        $headline = $this->loadHeadlineJSON($request);

        $query = "Jakarta";
        $weather = $this->loadWeatherJSON($request, $query);

        return view('news.newslist', ['newsData' => $newsData, 'headline' => $headline, 'user' => $user, 'weather' => $weather]);
    }

    public function loadWeatherJSON(Request $request, String $query){
        $apiKey = 'de33cdfa9dd740cab7515437232712';
        $url = 'http://api.weatherapi.com/v1/current.json?key=' . $apiKey . '&q=' . $query . '&aqi=yes';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        return $response;
    }

    public function loadNewsJSON(Request $request, String $query){
        $apiKey = 'c5477f93c91c4229aaff8b842268f3cf';
        $url = 'https://newsapi.org/v2/everything?q=' . $query . '&apiKey=' . $apiKey;
        $ua = $request->server('HTTP_USER_AGENT');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => $ua,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        return $response;
    }

    public function loadHeadlineJSON(Request $request)
    {
        $apiKey = 'c5477f93c91c4229aaff8b842268f3cf';
        $url = 'https://newsapi.org/v2/top-headlines?country=id&apiKey=' . $apiKey;
        $ua = $request->server('HTTP_USER_AGENT');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_USERAGENT => $ua,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        return $response;
    }

    public function load(Request $request){
        $newsData = $this->loadNewsJSON($request, "berita+terkini");

        return $this->returnView($request, $newsData);
    }

    public function loadTechNews(Request $request){
        $newsData = $this->loadNewsJSON($request, "berita+teknologi");

        return $this->returnView($request, $newsData);
    }

    public function loadSportNews(Request $request){
        $newsData = $this->loadNewsJSON($request, "berita+olahraga");

        return $this->returnView($request, $newsData);
    }
}
