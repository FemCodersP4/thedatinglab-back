<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MatchingController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\PreferencesController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ExportController;
use Spatie\Permission\Middleware\RoleMiddleware;


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

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::post('/event', [EventController::class, 'store']);
    Route::put('/event/{id}', [EventController::class, 'update']);
    Route::delete('event/{event}', [EventController::class, 'destroy']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/preferences/{id}', [UserController::class, 'getPreferences']);
    Route::put('/preferences/{id}', [PreferencesController::class, 'update']);
    Route::get('/export', [ExportController::class, 'export']);
    Route::get('export/event/attendance', [ExportController::class, 'exportEventAttendance']);
    Route::get('export/matching/{id}', [ExportController::class, 'exportMatches']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/event', [EventController::class, 'index']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/page', [EventController::class, 'getEventsPagination']);




Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/preferences', [PreferencesController::class, 'store']);
    Route::post('/profile', [ProfileController::class, 'store']);
    Route::get('/profile/{id}', [ProfileController::class, 'show']);
    Route::post('/profile/{id}', [ProfileController::class, 'update']);
    Route::get('/matching-users', [MatchingController::class, 'getMatches']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/event/attendance/{id}', [AttendancesController::class, 'confirmAttendance']);
    Route::get('/event/attendance/{id}', [AttendancesController::class, 'eventAttendees']);
    Route::get('/event/user/{id}', [AttendancesController::class, 'getEventsForUser']);
    Route::get('/event/{id}', [EventController::class, 'show']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
});
