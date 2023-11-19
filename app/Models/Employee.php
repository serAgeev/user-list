<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'job_id',
        'department_id',
        'work_type_id',
        'salary_type_id',
        'typical_hour',
        'annual_salary',
        'hourly_rate',
    ];
    public $timestamps = false;

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function workType()
    {
        return $this->belongsTo(WorkType::class);
    }
    public function salaryType()
    {
        return $this->belongsTo(SalaryType::class);
    }

}
