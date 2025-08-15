<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IncidentReportController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmergencyContactController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminDirectoryController;

/*
|--------------------------------------------------------------------------- 
| Web Routes 
|--------------------------------------------------------------------------- 
| Here is where you can register web routes for your application. 
| These routes are loaded by the RouteServiceProvider within a group 
| which contains the "web" middleware group.
|
*/

// Home Route - Redirect logged-in users to the dashboard
Route::get('/home', function () {
    if (Auth::check()) {
        return view('dashboard');  // Redirect to dashboard if the user is logged in
    }
    return view('welcome');  // Show home page if the user is not logged in
})->name('home');

// Login routes (for guests only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthManager::class, 'login'])->name('login');
    Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
    
    Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
    Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');
});

// Logout route
Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');

// Define the dashboard route for authenticated users
Route::middleware(['auth'])->get('/dashboard', function () {
    // Redirect to appropriate dashboard based on the role of the user
    if (Auth::user()->is_admin) {
        return redirect()->route('admin.dashboard');  // Redirect to admin dashboard if the user is an admin
    }
    return view('dashboard');  // Redirect to the user dashboard if the user is not an admin
})->name('dashboard');

// Routes for authenticated users (Profile, Incident Reporting)
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Incident reporting routes
    Route::get('/incident/create', [IncidentReportController::class, 'create'])->name('incident.create');
    Route::post('/incident/store', [IncidentReportController::class, 'store'])->name('incident.store');
    
    // Emergency Contact Routes
    Route::get('/contacts', [EmergencyContactController::class, 'index'])->name('contacts.index'); // View all contacts
    Route::get('/contacts/create', [EmergencyContactController::class, 'create'])->name('contacts.create'); // Add a new contact
    Route::post('/contacts', [EmergencyContactController::class, 'store'])->name('contacts.store'); // Store new contact
    Route::get('/contacts/{id}/edit', [EmergencyContactController::class, 'edit'])->name('contacts.edit'); // Edit an existing contact
    Route::put('/contacts/{id}', [EmergencyContactController::class, 'update'])->name('contacts.update'); // Update the contact
    Route::delete('/contacts/{id}', [EmergencyContactController::class, 'destroy'])->name('contacts.destroy'); // Delete a contact
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/reports', [AdminReportController::class,'index'])->name('reports.index');
    Route::get('/reports/{report}', [AdminReportController::class,'show'])->name('reports.show');
    Route::patch('/reports/{report}/flag', [AdminReportController::class,'toggleFlag'])->name('reports.flag');
    Route::patch('/reports/{report}/status', [AdminReportController::class,'updateStatus'])->name('reports.status');
    Route::delete('/reports/{report}', [AdminReportController::class,'destroy'])->name('reports.destroy');

    Route::get('/users', [AdminUserController::class,'index'])->name('users.index');
    Route::patch('/users/{user}/role', [AdminUserController::class,'toggleAdmin'])->name('users.role');
    Route::patch('/users/{user}/status', [AdminUserController::class,'toggleActive'])->name('users.status');

    Route::get('/directory', [AdminDirectoryController::class,'index'])->name('directory.index');
    Route::post('/directory', [AdminDirectoryController::class,'store'])->name('directory.store');
    Route::put('/directory/{entry}', [AdminDirectoryController::class,'update'])->name('directory.update');
    Route::delete('/directory/{entry}', [AdminDirectoryController::class,'destroy'])->name('directory.destroy');
});

// Redirect to home page if no route matches
Route::get('/', function () {
    return view('welcome');
});