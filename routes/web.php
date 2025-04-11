<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\DashboardController;

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

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/member/dashboard', function () {
//     return view('member.dashboard');
// })->middleware(['auth', 'role:member'])->name('member.dashboard');

Route::middleware(['auth', 'role:member'])->prefix('member')->group(function ()
{
    Route::get('/dashboard', function () {
        return view('member.dashboard');
    })->name('member.dashboard');

    Route::get('/book',[BookingController::class,'create'])->name('booking.create');
    Route::post('/book',[BookingController::class,'store'])->name('booking.store');
    Route::get('/bookings',[BookingController::class,'index'])->name('booking.index');
    Route::delete('/bookings/{id}',[BookingController::class,'destroy'])->name('booking.destroy');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');

Route::middleware(['auth', 'role:instructor'])->prefix('instructor')->group(function () {
    Route::get('/dashboard', function () {
        return view('instructor.dashboard');
    })->name('instructor.dashboard');

    Route::resource('/schedule', ScheduleController::class)->only(['index', 'create', 'store', 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
