<?php

use App\Models\Blog;
use App\Models\Contact;
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
Route::get('/blogs', function () {
    return Blog::latest()->get();
  });
  
Route::get('/blogs/{slug}', function ($slug) {
    return Blog::where('slug', $slug)->firstOrFail();
    $blog = Blog::find($id);
    $paragraphs = $blog->description_paragraphs;
    $blog->append('description_paragraphs');
});
Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'message' => 'required|string',
    ]);

    Contact::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Message has been send.'
    ], 201);
});
