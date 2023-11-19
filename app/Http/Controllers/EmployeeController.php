<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\EmployeeSearchRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function searchByName(EmployeeSearchRequest $request)
    {
        $employee = Employee::query()
            ->where('name', $request->name)
            ->firstOrFail();

        return new EmployeeResource($employee);
    }
}
