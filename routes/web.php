<?php


use App\Http\Controllers\{
    CommentController,
    UserController
};
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function() {
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::delete('users/{id}', [UserController::class, 'delete'])->name('users.delete');
    
    Route::get('/users/{id}/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::get('/users/show/{user}/comments/{id}', [CommentController::class, 'show'])->name('comments.show');
    Route::get('/users/{id}/comments/create', [CommentController::class, 'create'])->name('comments.create');
    Route::post('/users/{id}/comments/store', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/users/{id}/comments/update', [CommentController::class, 'update'])->name('comments.update');
    Route::get('/users/{user}/comments/{id}', [CommentController::class, 'edit'])->name('comments.edit');
    Route::delete('/users/comments/{user}/{id}', [CommentController::class, 'destroy'])->name('comments.delete');

});



require __DIR__.'/auth.php';
