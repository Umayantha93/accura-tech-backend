<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/search/{name}', [MemberController::class, 'searchMember']);

Route::get('/members-list', [MemberController::class, 'listMembers']);
Route::post('/add-member', [MemberController::class, 'addMember']);
Route::put('/update-member/{id}', [MemberController::class, 'update']);
Route::delete('/delete-member/{id}', [MemberController::class, 'destroy']);
Route::get('/select-member/{id}', [MemberController::class, 'getMember']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

