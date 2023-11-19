<?php

namespace App\Console\Commands;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Job;
use App\Models\SalaryType;
use App\Models\WorkType;
use Illuminate\Console\Command;

class ParseCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $row = 1;
        if (($handle = fopen(public_path('/parse/data.csv'), "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                if ($row == 1) {
                    $row++;
                    continue;
                }

                $row++;

                $userData = [
                    'name' => $data[0],
                    'job_id' => $this->getJobIdByName($data[1]),
                    'department_id' => $this->getDepartmentIdByName($data[2]),
                    'work_type_id' => !empty($data[3]) ? $this->getWorkTypeIdByName($data[3]) : null,
                    'salary_type_id' => !empty($data[4]) ? $this->getSalaryTypeIdByName($data[4]) : null,
                    'typical_hour' => !empty($data[5]) ? $data[5] : null,
                    'annual_salary' => !empty($data[6]) ? $data[6] : null,
                    'hourly_rate' => !empty($data[7]) ? $data[7] : null,
                ];

                Employee::query()
                    ->create($userData);
            }
            fclose($handle);
        }
    }

    /**
     * @param string $name
     * @return int
     */
    private function getDepartmentIdByName(string $name) : int
    {
        $department = Department::query()
            ->where('name', $name)
            ->first('id');

        if (!$department) {
            $department = Department::query()
                ->create([
                    'name' => $name
                ]);
        }

        return $department->id;
    }

    /**
     * @param string $name
     * @return int
     */
    private function getJobIdByName(string $name) : int
    {
        $job = Job::query()
            ->where('name', $name)
            ->first('id');

        if (!$job) {
            $job = Job::query()
                ->create([
                    'name' => $name
                ]);
        }

        return $job->id;
    }

    /**
     * @param string $name
     * @return int|null
     */
    private function getWorkTypeIdByName(string $name) : int|null
    {
        $workType = WorkType::query()
            ->where('name', $name)
            ->first('id');

        if (!$workType) {
            $workType = WorkType::query()
                ->create([
                    'name' => $name
                ]);
        }

        return $workType->id;
    }

    private function getSalaryTypeIdByName(string $name) : int|null
    {
        $salaryType = SalaryType::query()
            ->where('name', $name)
            ->first('id');

        if (!$salaryType) {
            $salaryType = SalaryType::query()
                ->create([
                    'name' => $name
                ]);
        }

        return $salaryType->id;
    }
}
