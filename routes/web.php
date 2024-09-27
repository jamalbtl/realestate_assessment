<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index']);

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware'=>['auth','role:Super Admin|Admin']],function () {

    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [PermissionController::class,'destroy'])->middleware('permission: delete permission');
    
    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/delete', [RoleController::class,'destroy']);
    Route::get('roles/{roleId}/give-permission', [RoleController::class,'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permission', [RoleController::class,'givePermissionToRole']);
    
    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete', [UserController::class,'destroy']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('property', PropertyController::class);
    Route::get('property/{propertyId}/delete', [PropertyController::class,'destroy']);
    Route::get('/property-image/{imageId}/delete', [PropertyController::class, 'destroyPropertyImage']);
});

require __DIR__.'/auth.php';
