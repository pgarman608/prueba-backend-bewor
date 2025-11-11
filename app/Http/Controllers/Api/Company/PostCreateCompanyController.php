<?php

namespace App\Http\Controllers\Api\Company;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CreateCompanyRequest;
use OptimaCultura\Company\Application\CompanyCreator;

class PostCreateCompanyController extends Controller
{
    /**
     * Crear una compañia
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CreateCompanyRequest $request, CompanyCreator $service)
    {
        DB::beginTransaction();
        try {
            $company = $service->handle(Str::uuid(), $request->name, $request->email,$request->address ,$request->status);
            DB::commit();
            return response($company, 201);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }
}