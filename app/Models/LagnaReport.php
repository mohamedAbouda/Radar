<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LagnaReport extends Model
{
    protected $table = 'lagna_report';
    protected $fillable = ['fine','fine_cause','lagna_id','note'];
}
