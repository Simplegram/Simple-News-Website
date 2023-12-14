<?php

namespace App\Http\Controllers;

use App\Http\Controllers\NewsController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class NewsController extends Controller
{
    private $users;

    public function __construct()
    {
        $this->users = new User();
    }

    public function loadNewsJSON(Request $request){
        $apiKey = 'c5477f93c91c4229aaff8b842268f3cf';
        $url = 'https://newsapi.org/v2/everything?q=berita+indonesia&apiKey=' . $apiKey;
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
        $value = Auth::id();
        $user = $this->users->find($value);

        $headline = $this->loadHeadlineJSON($request);
        $newsData = $this->loadNewsJSON($request);

        return view('news.newslist', ['newsData' => $newsData, 'headline' => $headline, 'user' => $user]);
    }
}
