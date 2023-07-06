<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\SessionController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [InvoiceController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('invoices', InvoiceController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

Route::get('/upload', function () {
    return view('uploadInvoice');
})->middleware(['auth'])->name('uploadInvoice');

Route::get('/view', function () {
    return view('viewInvoice');
})->middleware(['auth'])->name('viewInvoice');

Route::post('/upload-pdf', [UploadFileController::class, 'uploadPDF'])->middleware(['auth'])->name('upload.invoice');

Route::post('/store-data-in-session', [SessionController::class, 'storeDataInSession']);

require __DIR__ . '/auth.php';
