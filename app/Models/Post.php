<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'company',
        'location',
        'salary',
        'industry',
        'jobType',
        'seniority',
        'about',
        'responsibilities',
        'requirements',
        'image',
        'logo',
        'user_id',
        'industry_id',
        'job_type_id',
        'seniority_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }

    public function seniority()
    {
        return $this->belongsTo(Seniority::class, 'seniority_id');
    }
}
