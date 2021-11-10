<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'user_id'
    ];

    public function company(){
        return $this->hasMany('App\Models\Company');
    }
}
