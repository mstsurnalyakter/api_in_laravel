<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UsersAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/test', function(){
//     return "Test route is working";
// });


// user authentication
Route::post('signup', [UsersAuthController::class, 'signup']);
Route::post('login', [UsersAuthController::class, 'login']);

Route::group(["middleware"=>["auth:sanctum"]],function(){
    Route::post('add-student', [StudentsController::class, 'addStudent']);
    Route::get('students', [StudentsController::class, 'list']);
    Route::put('update-student/{id}', [StudentsController::class, 'updateStudent']);
    Route::delete('delete-student/{id}',[StudentsController::class,'deleteStudent']);
    Route::get('search-student/{studentname}',[StudentsController::class,'searchStudent']);

    // resource controller
Route::resource('members',MemberController::class);
    
});




