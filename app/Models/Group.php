<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $fillable = ['name','image','admin_id'];

    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'group_user','group_id','user_id');
    }
}
