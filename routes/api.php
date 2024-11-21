<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Backoffice\EventsController;
use App\Http\Controllers\Backoffice\CertificateController;
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

Route::any('/events/monitor', [EventsController::class, 'monitorEvents']);
Route::post('/certificate/distribute', [CertificateController::class, 'distributeCertificate']);