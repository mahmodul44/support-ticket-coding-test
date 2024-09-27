<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
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
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/tickets', [TicketController::class, 'adminIndex'])->name('admin.tickets');
        Route::get('/admin/tickets/{id}', [TicketController::class, 'viewTicket'])->name('admin.ticket.view');
        Route::post('/admin/tickets/{id}', [TicketController::class, 'updateTicket'])->name('admin.ticket.update');
    });

    Route::middleware(['customer'])->group(function () {
        Route::get('/customer/tickets', [TicketController::class, 'customerIndex'])->name('customer.tickets');
        Route::post('/customer/tickets', [TicketController::class, 'store'])->name('tickets.store');
        Route::get('/customer/tickets/{id}', [TicketController::class, 'viewCustTicket'])->name('customer.ticket.view');
    });
});
