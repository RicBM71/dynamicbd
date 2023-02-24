<?php

use App\Models\Post;
use App\Models\PostB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/config/{bd}', function (Request $request, $bd) {

    session(['dynamic_database' => $bd]);

    return $bd;

});

Route::middleware('dynamic')->get('/post', function (Request $request) {

    return Post::findOrfail(1)->titulo;

});

Route::middleware('dynamic')->get('/post/{post}', function (Post $post) {

    return $post->titulo;

});

Route::get('/postb/{post}', function (PostB $post) {

    return $post->titulo;

});

Route::get('/postb', function (PostB $post) {

    return Post::findOrfail(1)->titulo;

});
