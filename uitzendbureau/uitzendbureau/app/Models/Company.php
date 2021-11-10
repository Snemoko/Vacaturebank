<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasMany('App\Models\User');
    }
    public function company(){
        return $this->hasOne('App\Models\Advert');
    }

    protected $fillable = [
        'company_name',
        'kvk',
        'user_id'
    ];
}
