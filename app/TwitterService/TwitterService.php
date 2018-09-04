<?php

namespace App\TwitterService;

use Codebird\Codebird;
use App\TwitterStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\GeoData;

class TwitterService
{
    protected $codebird, $geodata;

    public function __construct(Codebird $codebird, GeoData $geodata)
    {
        $this->codebird = $codebird;
        $this->geodata = $geodata;
    }

//  Функция инициализации для Codebird, хранит ключи для доступа к API
    public function initLib()
    {
        $this->codebird->setConsumerKey(env('TWITTER_CONSUMER_KEY'), env('TWITTER_CONSUMER_SECRET'));
        $cb = $this->codebird->getInstance();
        $cb->setToken(env('TWITTER_ACCESS_TOKEN'), env('TWITTER_ACCESS_TOKEN_SECRET'));
        return $cb;
    }

//  Функция для поиска твитов по заданным параметрам(геокоду, ключевому слову)
    public function fetchTwits()
    {
        $cb = $this->initLib();
//      Параметры для поиска
        $geodata = $this->geodata->where('id', 1)->first();
        $keyword = $geodata->keyword;
        $lat = $geodata->latitude;
        $lng = $geodata->longtitude;
        $radius = $geodata->radius;

        $geocode = $lat . "," . $lng . "," . $radius . "km";
        $params = [
            'q' => $keyword,
            'geocode' => $geocode,
        ];
//        $params = [
//            'q' => 'Football',
//            'geocode' => "51.5085300,-0.1257400,10km",
////            'include_entities' => true
//        ];
        $reply = $cb->search_tweets($params)->statuses;
        return $reply;
    }

//  Функция записи полученных твитов в базу данных
    public function twitterDB()
    {
        $reply = $this->fetchTwits(); //переменная с твитами

        foreach ($reply as $p) {
            $tweet = new TwitterStorage();
            $created = str_replace("+0000", "", $p->created_at);
            $tweet->text = $p->text;
//            if(strlen($p->entities->hashtags."")<254) {
            $tweet->hashtags = $p->entities->hashtags;
//            }
//            $tweet->created_post = $p->created_at;
            $tweet->created_post = $created;
            $tweet->username = $p->user->name;
            $tweet->user_img = $p->user->profile_image_url_https;
            $tweet->save();
        }
        return $reply;
    }
}
