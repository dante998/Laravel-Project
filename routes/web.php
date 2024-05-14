<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserImageController;

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

// Anonymous user
Route::get('/', function () {
    return view('welcome');
})->middleware('isAnonymous');



// Admin
Route::group(['middleware' => ['isAdmin']], function() {

    Route::resource('users', App\Http\Controllers\UserController::class);           
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);
    Route::delete('roles/{roleId}/permissions/{permissionId}', [App\Http\Controllers\RoleController::class, 'removePermissionFromRole']);

    Route::get('images', [App\Http\Controllers\ImageController::class, 'index'])->name('images.index');

});



// Authenticated user
Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user-profile/{name}', [App\Http\Controllers\UserProfileController::class, 'show']);
    Route::get('/user-profiles', [App\Http\Controllers\UserProfileController::class, 'index']);

    Route::get('/dashboard', [UserImageController::class, 'index'])->name('dashboard');

    Route::get('images/create', [App\Http\Controllers\ImageController::class, 'create']);
    Route::post('images/create', [App\Http\Controllers\ImageController::class, 'store']);
    Route::get('images/{id}/edit', [App\Http\Controllers\ImageController::class, 'edit']);
    Route::put('images/{id}/edit', [App\Http\Controllers\ImageController::class, 'update']);
    Route::get('images/{id}/delete', [App\Http\Controllers\ImageController::class, 'destroy']);
    Route::get('user-profile/{user}/images/{id}', [App\Http\Controllers\ImageController::class, 'show'])->name('images.show');
    Route::post('images/{id}/comments', [App\Http\Controllers\ImageController::class, 'storeComment'])->name('images.comments.store');
    Route::delete('/comments/{id}', [App\Http\Controllers\ImageController::class, 'destroyComment'])->name('comments.destroy');

    Route::get('/contact', [App\Http\Controllers\ContactController::class, 'show'])->name('contact.show');
    Route::post('/contact', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');
   
});

require __DIR__.'/auth.php';




