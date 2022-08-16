<?php

namespace App\Http\Controllers;

use App\Http\Resources\HR\ApplicantResource;
use App\Services\EmployeeManagement\Applicant;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class JobController extends Controller
{
    use ResponseTrait;

    protected $applicant;
    
    public function __construct(Applicant $applicant)
    {
        $this->applicant = $applicant;
    }
    
    public function apply(): JsonResponse
    {
        $data = $this->applicant->applyJob();
        
        return $this->responseSuccess('success', new ApplicantResource($data));
    }
}
