<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController as AdminProfileController;
use App\Http\Controllers\ProfileController as UserProfileController;
use Illuminate\Support\Facades\Route;




// Route::middleware('admin','auth')->as('dashbourd.')->prefix('dashboard')->group(function(){});

Route::get('redirect', [DashboardController::class, 'redirect'])->name('redirect');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::group([
    'middleware' => ['auth','admin:admin,super_admin'] ,
    'as' => 'dashboard.',
    'prefix' => 'dashboard/'
],function(){
    //  categories 
    Route::get('categories/trash',[CategoryController::class ,'trash'])
    ->name('categories.trash');
    
    Route::put('categories/restore/{id}',[CategoryController::class , 'restore'])
    ->name('categories.restore');
    
    Route::delete('categories/forceDelete/{id}',[CategoryController::class , 'forceDelete'])
    ->name('categories.forceDelete');
    
    Route::resource('categories',CategoryController::class);

    Route::resource('products',ProductController::class);

    Route::get('profile/edit',[AdminProfileController::class,'edit'])->name('profile.edit');
    Route::put('profile/update',[AdminProfileController::class,'update'])->name('profile.update');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');
});



