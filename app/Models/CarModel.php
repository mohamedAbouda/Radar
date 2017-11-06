<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Http\UploadedFile;

class CarModel extends Model
{
    protected $table = 'models';
    protected $fillable = ['name','pic'];

    protected $appends = [
        'pic_url'
    ];

    /**
    * Upload path for user's images
    *
    * @var string
    */
    public $upload_distination = '/uploads/carmodels/';

    /**
    * Accessors & Mutators
    */
    public function setPicAttribute($value)
    {
        $this->attributes['pic'] = $this->uploadFile($value);
    }
    public function getPicUrlAttribute()
    {
        return asset($this->upload_distination.$this->pic);
    }

    /**
     * Upload files for mutators
     * @param  [UploadedFile,String] $value
     * @return [string]
     */
    private function uploadFile($value)
    {
        if (!$value instanceof UploadedFile) {
            return $value;
        }
        $image_name = str_random(60);
        $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
        $value->move(public_path($this->upload_distination),$image_name);
        return $image_name;
    }

    /**
    * Relations
    */
    public function cars()
    {
        return $this->hasMany(Car::class,'model_id');
    }
}
