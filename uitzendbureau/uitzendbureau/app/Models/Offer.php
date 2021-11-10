<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'category_id',
    ];

    public function job_offer(){
        return $this->hasMany('App\Models\Job_Offer');
    }

    public function category(){
        return $this->hasMany('App\Models\Category');
    }
}
