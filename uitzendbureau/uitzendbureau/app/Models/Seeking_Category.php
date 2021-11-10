<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seeking_Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'seeker_id'
    ];

    public function job_seeker(){
        return $this->hasOne('App\Models\Job_seeker');
    }

    public function category(){
        return $this->hasOne('App\Models\Category');
    }
    public function user(){
        return $this->hasOne('App\Models\User');
    }
}
