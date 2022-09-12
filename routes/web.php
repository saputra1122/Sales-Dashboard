<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Live
Route::get('/live', [App\Http\Controllers\HomeController::class, 'live'])->name('live');
Route::get('/live_client', [App\Http\Controllers\HomeController::class, 'liveClient'])->name('live_client');
// Ruang Kerja
Route::get('/ruang_kerja', [App\Http\Controllers\RuangKerja\RuangKerjaController::class, 'index'])->name('ruang_kerja');
// Header Report Target
Route::post('/header_report_target/create', [App\Http\Controllers\HeaderReportTarget\HeaderReportTargetController::class, 'create'])->name('header_report_target.create');
Route::post('/header_report_target/live', [App\Http\Controllers\HeaderReportTarget\HeaderReportTargetController::class, 'live'])->name('header_report_target.live');
// Report Target
Route::post('/report_target/create', [App\Http\Controllers\HeaderReportTarget\ReportTargetController::class, 'create'])->name('report_target.create');
// Report Target 2
Route::post('/report_target/create2', [App\Http\Controllers\HeaderReportTarget\ReportTargetController::class, 'create2'])->name('report_target.create2');
