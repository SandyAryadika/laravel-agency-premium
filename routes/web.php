<?php

use App\Livewire\Dashboard;
use App\Models\User;
use App\Livewire\Projects\Index as ProjectIndex;
use App\Livewire\Projects\Create as ProjectCreate;
use App\Livewire\Projects\Show as ProjectShow;
use App\Livewire\Projects\Edit as ProjectEdit;
use App\Livewire\Invoices\Index as InvoiceIndex;
use App\Livewire\Invoices\Create as InvoiceCreate;
use App\Livewire\Invoices\Edit as InvoiceEdit;
use App\Livewire\Clients\Index as ClientIndex;
use App\Livewire\Clients\Create as ClientCreate;
use App\Livewire\Clients\Edit as ClientEdit;
use App\Http\Controllers\InvoicePdfController;
use App\Livewire\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;

Route::middleware('guest')->group(function () {
    Route::get('/', Login::class)->name('login');
    Route::get('/login', Login::class);

    Route::get('/', Login::class)->name('login');
    Route::get('/login', Login::class);
});

Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::middleware(['auth'])->group(function () {

    // Dashboard (PENTING: Harus ada di sini)
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Projects Routes
    Route::get('/projects', ProjectIndex::class)->name('projects.index');
    Route::get('/projects/create', ProjectCreate::class)->name('projects.create');
    Route::get('/projects/{project}', ProjectShow::class)->name('projects.show');
    Route::get('/projects/{project}/edit', ProjectEdit::class)->name('projects.edit');

    // Invoices Routes
    Route::get('/invoices', InvoiceIndex::class)->name('invoices.index');
    Route::get('/invoices/create', InvoiceCreate::class)->name('invoices.create');
    Route::get('/invoices/{invoice}/edit', InvoiceEdit::class)->name('invoices.edit');

    // Expenses Routes
    Route::get('/expenses', App\Livewire\Expenses\Index::class)->name('expenses.index');

    // Clients Routes
    Route::get('/clients', ClientIndex::class)->name('clients.index');
    Route::get('/clients/create', ClientCreate::class)->name('clients.create');
    Route::get('/clients/{client}/edit', ClientEdit::class)->name('clients.edit');

    // Settings
    Route::get('/settings', Settings::class)->name('settings');

    // PDF
    Route::get('/invoices/{invoice}/pdf', [InvoicePdfController::class, 'download'])->name('invoices.pdf');

    // Forgot Password
    Route::get('/forgot-password', App\Livewire\Auth\ForgotPassword::class)->name('password.request');
});
