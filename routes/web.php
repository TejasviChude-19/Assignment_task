<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;


Route::get('/test-db', function () {
    try {
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=user_application', 'root', 'root');
        echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
});
 
    Route::get('/login', [AuthController::class, 'loginIndex'])->name('login');
    Route::get('/register', [AuthController::class, 'registerIndex'])->name('register');

    Route::post('/login', [AuthController::class, 'login'])->name('processlogin');
    Route::post('/register', [RegisterController::class, 'register'])->name('processregister');

    Route::get('/welcome', [WelcomeController::class, 'welcome'])->name('welcomepage');

           
// Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    
// // Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
//     Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
//     Route::post('/admin/users/store', [UserController::class, 'store'])->name('admin.users.store');
//     // Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
//     Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
//     Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
//     Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
//     Route::get('/admin/users/{user}/role', [UserController::class, 'role'])->name('admin.users.role');


//admin
Route::get('admin/users', [AdminController::class, 'index'])->name('admin.users.index');
Route::get('admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
Route::post('admin/users', [AdminController::class, 'store'])->name('admin.users.store');
Route::get('admin/users/{id}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
Route::put('admin/users/{id}', [AdminController::class, 'update'])->name('admin.users.update');
Route::delete('admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
Route::get('users/{user}/role', [AdminController::class, 'editRole'])->name('admin.users.role');
Route::put('users/{user}/role', [AdminController::class, 'updateRole'])->name('admin.users.updateRole');

Route::middleware('auth')->group(function () {
    Route::get('/', [WelcomeController::class, 'index']);
    Route::get('logout', [AuthController::class, 'logout']);
});
