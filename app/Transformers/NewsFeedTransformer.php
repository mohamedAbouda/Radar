<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\NewsFeed;

class NewsFeedTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(NewsFeed $news)
    {
        return [
            'cover_picture' => $news->cover_picture_url,
            'title' => $news->title,
            'description' => $news->description,
        ];
    }
}
