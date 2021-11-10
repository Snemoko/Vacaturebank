<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_offer extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasMany('App\Models\Company');
    }

    protected $fillable = [
        'job_title',
        'hours',
        'text',
        'labor_contract',
        'working_conditions',
        'contract',
        'ethic',
        'dismissal',
        'health_safety',
        'company_id'
    ];

}
