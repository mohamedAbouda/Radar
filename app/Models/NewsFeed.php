<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class NewsFeed extends Model
{
    protected $table = 'news_feeds';
    protected $fillable = ['title' , 'admin_id' , 'description' , 'cover_picture'];
    protected $appends = ['cover_picture_url'];

    /**
    * Upload path for user's images
    *
    * @var string
    */
    public $upload_distination = '/uploads/images/news/';
    /**
     * Accessors & Mutators
     */
     public function getCoverPictureUrlAttribute()
     {
         return asset($this->upload_distination.$this->cover_picture);
     }
     public function setCoverPictureAttribute($value)
     {
         if (!$value instanceof UploadedFile) {
             return;
         }
         $image_name = str_random(60);
         $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
         $value->move(public_path($this->upload_distination),$image_name);
         $this->attributes['cover_picture'] = $image_name;
     }
}
