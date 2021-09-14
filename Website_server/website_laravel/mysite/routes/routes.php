<?php

Route::get('/',function(){
    return view('welcome');
});

Route::post('/insert',[MovieController::class,'insertMovie'])->name('insert');;
Route::get('/display',[MovieController::class,'listMovie'])->name('display');;