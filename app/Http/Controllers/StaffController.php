<?php

namespace App\Http\Controllers;

use App\Http\Resources\HR\StaffResource;
use App\Services\EmployeeManagement\Staff;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class StaffController extends Controller
{
    use ResponseTrait;

    protected $staff;
    
    public function __construct(Staff $staff)
    {
        $this->staff = $staff;
    }
    
    public function payroll(): JsonResponse
    {
        $data = $this->staff->salary();
    
        return $this->responseSuccess('success', new StaffResource($data));
    }
}
