<?php

//use App\Http\Controllers\AppController@index;
use App\Http\Controllers\AppController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Auth::routes();
Route::get('{any}', 'AppController@index')
    ->where('any', '.*')
    ->middleware('auth')
    ->name('home');
/*
Route::get('/test', function(){
     $servername = ENV("DB_HOST");
     $username = ENV("DB_USERNAME");
     $password = ENV("DB_PASSWORD");
     try{
         $conn = new PDO("mysql:host=$servername;dbname=facebook-app", $username, $password);


         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         echo "connected successfully";
     }

     catch(PDOException $e){
         echo "connection failed:".$e->getMessage();
     }
});
*/
