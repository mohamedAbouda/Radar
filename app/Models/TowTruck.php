<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class TowTruck extends Model
{
    protected $table = 'tow_trucks';
    protected $fillable = [
        'name','phone','pic'
    ];
    protected $appends = ['pic_url'];

    /**
    * Upload path for user's images
    *
    * @var string
    */
    protected $upload_distination = '/uploads/images/towtrucks/';

    /**
     * Accessors & Mutators
     */
    public function getPicUrlAttribute()
    {
        return asset($this->upload_distination.$this->pic);
    }
    public function setPicAttribute($value)
    {
        if (!$value instanceof UploadedFile) {
            return;
        }
        $image_name = str_random(60);
        $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
        $value->move(public_path($this->upload_distination),$image_name);
        $this->attributes['pic'] = $image_name;
    }

    /**
     * Relations
     */
    public function accidents()
    {
        return $this->hasMany(TowTruckAccident::class, 'tow_truck_id');
        // return $this->belongsToMany(Accedent::class, 'tow_truck_accidents', 'tow_truck_id', 'accident_id');
    }
}
