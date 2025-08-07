<?php

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('/blogs', [BlogController::class, 'index']);
// Route::get('/blogs/{slug}', [BlogController::class, 'show']);
Route::get('/blogs', function () {
    return Blog::latest()->get();
  });
  
Route::get('/blogs/{slug}', function ($slug) {
    return Blog::where('slug', $slug)->firstOrFail();
    $blog = Blog::find($id);
    $paragraphs = $blog->description_paragraphs;
    $blog->append('description_paragraphs');
});