<?php

use App\Http\Controllers\AnnualFeeController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\DepartmentAcademicSessionController;
use App\Http\Controllers\DepartmentClassController;
use App\Http\Controllers\DepartmentClassSubjectController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\InstituteUpdateController;
use App\Http\Controllers\MonthlyFeeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response(['Laravel' => app()->version()], 200);
}); 

Route::get('/app', AppController::class);

Route::put('/app/institute/name', [InstituteUpdateController::class, 'name']);

Route::post('/login', [UserController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [UserController::class, 'user']);
    Route::post('/logout', [UserController::class, 'logout']);

    Route::get('/institute', [InstituteController::class, 'index']);
    Route::get('/institute/{key}', [InstituteController::class, 'show']);
    Route::put('/institute/{key}', [InstituteController::class, 'update']);

    Route::apiResource('packages', PackageController::class);
    Route::apiResource('fees', FeeController::class);

    Route::apiResource('monthly-fees', MonthlyFeeController::class);
    Route::apiResource('annual-fees', AnnualFeeController::class);

    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('departments.classes', DepartmentClassController::class);
    Route::apiResource('departments.classes.subjects', DepartmentClassSubjectController::class);
    
    Route::apiResource('departments.academic-sessions', DepartmentAcademicSessionController::class);
});

Route::get('/php-artisan/{command?}', function ($command = 'list') {

    // dd(DB::connection('dynamic'));

    $allowCommands = [
        "migrate:install",
        "migrate:status",
        "migrate",
    ];

    if($command == 'list') {
        return $allowCommands;
    }

    if(!in_array($command, $allowCommands)) {
        return "Not Allow";
    }

    $parameters = [];

    if(Config::get("database.default") == "dynamic") {

        if($command == "migrate" || $command == "migrate:status") {
            $parameters["--path"] = "/database/migrations/clients";
        }
    }

    Artisan::call($command, $parameters);

    dd(Artisan::output());
});

Route::any('/{any}', function ($any) {
    return response("'{$any}' Not Found!", 404);
})->where('any', '.*');
