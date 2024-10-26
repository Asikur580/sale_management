<?php


use Inertia\Inertia;
use function Termwind\render;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('Home');
});
Route::get('/about', function () {
    return Inertia::render('About/About');
});



