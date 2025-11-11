
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\Company\CreateCompanyRequest;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Crear una compañia
Route::post('/company', [App\Http\Controllers\Api\Company\PostCreateCompanyController::class, '__invoke']);

//Recoger todas las compañias
Route::post('/company/active', [App\Http\Controllers\Api\Company\PostActiveCompanyController::class, '__invoke']);

//Listar todas las compañias
Route::get('/companies', [App\Http\Controllers\Api\Company\GetAllCompaniesController::class, '__invoke']);