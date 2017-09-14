<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NewsFeed;
use App\Transformers\NewsFeedTransformer;

class NewsFeedController extends Controller
{
    public function index(Request $request)
    {
        $limit = 20;
        $index = $request->get('index',1);
        $offset = $limit * $index - $limit;
        $news = NewsFeed::offset($offset)->take($limit)->get();
        return response()->json([
            'data'=>fractal()
            ->collection($news)
            ->transformWith(new NewsFeedTransformer)
            ->serializeWith(new \Spatie\Fractal\ArraySerializer())
            ->toArray(),
        ],200);
    }
}
