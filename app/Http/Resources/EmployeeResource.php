<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'job_name' => $this->job->name,
            'department_name' => $this->department->name,
            'work_type_name' => $this->workType->name,
            'salary_typ_name' => $this->salaryType->name,
            'typical_hour' => $this->typical_hour,
            'annual_salary' => $this->annual_salary,
            'hourly_rate' => $this->hourly_rate,
        ];
    }
}
