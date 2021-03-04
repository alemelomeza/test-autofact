<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\QuizResource;
use App\Models\Quiz;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/quizzes', function () {
    return new QuizResource(Quiz::all());
});
Route::middleware('auth:api')->post('/quizzes', function (Request $request) {
    $quiz = Quiz::create($request->only(['suggestion', 'right', 'speed', 'user_id']));
    return response()->json($quiz);
});

