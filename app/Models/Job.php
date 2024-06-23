<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'job_title',
        'total_positions',
        'start_in',
        'end_in',
        'working_hours',
        'workdays',
        'public_holidays',
        'job_category',
        'work_from',
        'type_employment',
        'job_description',
        'job_requirement',
        'skills',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function departmentname()
    {
        return $this->belongsTo('App\Models\Category','job_category');
    }

    public function candidates()
    {
        return $this->hasMany('App\Models\Candidate','job_id');
    }

    public function candidate()
    {
        return $this->belongsTo('App\Models\Candidate','job_id');
    }
}
