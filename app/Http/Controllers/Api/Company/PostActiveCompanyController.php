<?php

namespace App\Http\Controllers\Api\Company;

use Illuminate\Support\Str;
use App\Models\Company as ModelsCompany;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\ActiveCompanyRequest;
use OptimaCultura\Company\Application\CompanyActivator;

class PostActiveCompanyController extends Controller
{
    /**
     * Activar una compañia por ID
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ActiveCompanyRequest $request, CompanyActivator $service)
    {   
        DB::beginTransaction();
        try {
            //Get inactive companies
            $company = $service->handle($request->id);
            DB::commit();
            return response($company->toArray(), 201);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }
}
