<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');

Route::get('contacts/create', [ContactController::class, 'create'])->name('contacts.create');

Route::get('contacts/{id}', [ContactController::class, 'show'])->whereNumber('id')->name('contacts.show'); //->where('id', '[0-9]+')

Route::get('companies/{name?}', function($name = null){
    if ($name){
        return "Company " . $name;
    }else{
        return "All companies";
    } 
})->whereAlphaNumeric('name'); //->where('name', '[a-zA-Z]+'))

//To allow only alphanumeric use whereAlpha('var')

Route::fallback(function (){
    return "<h1>Not Found</h1>";
});