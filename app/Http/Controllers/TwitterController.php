<?php


namespace App\Http\Controllers;

use App\TwitterService\TwitterService;
use Illuminate\Support\Facades\Storage;
use App\TwitterStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class TwitterController extends Controller
{
    protected $twitterService, $twitterStorage;

    public function __construct(TwitterService $twitterService, TwitterStorage $twitterStorage)
    {
        $this->twitterService = $twitterService;
        $this->twitterStorage = $twitterStorage;
    }


    // функция для получения твитов от Twitter API
    public function twitterUserTimeLine()
    {
        dd($this->twitterService->fetchTwits());
    }

    // Функция которая добавляет подсчитывает количество твитов в БД
    public function getCount()
    {
//        return response()->json($this->twitterService->twitterDB());
        // добавление твитов (ограничение по количеству запросов ,убрано)
//        $this->twitterService->twitterDB();
        $max_id = $this->twitterStorage->count();
        return response()->json($max_id);
    }

    // выборка твитов для отправки
    public function getTweets(Request $request)
    {

        $max_id = $this->twitterStorage->count();
        $perPage = (int)$request->perPage;
        if ($request->page == 1) {
            $skip = $max_id - ($perPage * $request->page);
        } else {
            $skip = $request->totalData - ($perPage * $request->page);
        }
        $tweets = $this->twitterStorage->skip($skip)->take($perPage)->get();
        return response()->json($tweets);
    }

    // удаление заданного твита из БД
    public function delete(Request $request)
    {
        $id = $request->item;
        DB::table('twitter_storages')->where('id', '=', $id)->delete();
        $max_id = $this->twitterStorage->count();
        return response()->json($max_id);
    }

    public function update(Request $request)
    {
        $this->twitterStorage->where('id', $request->id)->update(['text' => $request->editText]);
        return response()->json("ok");
    }

    // добавление новых твитов в БД по запросу от админа
    public function updateDbAdmin()
    {
        $this->twitterService->twitterDB();
        return response()->json("ok");
    }

}

