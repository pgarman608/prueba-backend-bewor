<?php

namespace App\Http\Controllers\Api\Company;

use Illuminate\Support\Str;
use App\Models\Company as ModelsCompany;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OptimaCultura\Company\Application\CompanyLister;

class GetAllCompaniesController extends Controller
{
    /**
     * Recoger todas las compañias
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, CompanyLister $service)
    {   
        $companies = $service->handle();
        $companyArray = array_map(function ($company) {
            return $company->toArray();
        }, $companies);
        return response($companyArray, 201);
    }
}
