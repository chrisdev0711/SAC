<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\CleaningController;
use App\Http\Controllers\ApplianceController;
use App\Http\Controllers\PlugCheckController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\FaultDiagnosisController;
use App\Http\Controllers\QualityControlController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\CostingController;
use App\Http\Controllers\EbayController;
use App\Http\Controllers\FinalizedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageViewController;
use App\Http\Controllers\ReturnedController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/login');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', [ApplianceController::class, 'dashboard'])
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('appliances', ApplianceController::class);
        Route::resource('plug-checks', PlugCheckController::class);
        Route::resource('check-ins', CheckInController::class);
        Route::resource('fault-diagnoses', FaultDiagnosisController::class);
        Route::resource('cleanings', CleaningController::class);
        Route::resource('quality-controls', QualityControlController::class);
        Route::resource('listings', ListingController::class);
        Route::resource('costings', CostingController::class);
        Route::resource('ebays', EbayController::class);
        Route::resource('finalizeds', FinalizedController::class);
        Route::resource('actions', ActionController::class);
        Route::resource('users', UserController::class);
        Route::resource('returned', ReturnedController::class);

        Route::post('import', [ApplianceController::class, 'import'])->name('appliances.import');                
        Route::get('importView', [ApplianceController::class, 'importView'])->name('appliances.importView'); 
        Route::get('sac/{uuid}', [ApplianceController::class, 'qrScan'])->name('appliances.sac');
        Route::get('viewQr/{uuid}', [ApplianceController::class, 'viewQr'])->name('applications.viewQr');
        
        Route::get('viewAction', [ActionController::class, 'viewAction'])->name('actions.viewAction'); 
        Route::get('setStausScrapped', [PlugCheckController::class, 'setStatusScrapped'])->name('plug-checks.setStausScrapped');
    });
