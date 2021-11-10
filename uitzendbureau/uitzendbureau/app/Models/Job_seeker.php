<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_seeker extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne('App\Models\User');
    }

    protected $fillable = [
        'motivation',
        'portfolio',
        'user_id'
    ];
}
