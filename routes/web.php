<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ContactNotesController;

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

Route::get('/', WelcomeController::class);

//Agrupam-se os controladores e da-se o prefixo contacts. que é
//a pasta onde se encontram as views a ser carregadas
Route::controller(ContactController::class)->name('contacts.')->group(function () {
    Route::get('contacts', 'index')->name('index');
    Route::get('contacts/create', 'create')->name('create'); 
    Route::get('contacts/{id}', 'show')->whereNumber('id')->name('show'); 
});

//Uma Route::resource cria automaticamente todos os metodos CRUDE e as suas
//respetivas rotas
Route::resource('/companies', CompanyController::class);

//Colocar vários resources juntos
Route::resources([
    '/tags' => TagController::class,
    '/tasks' => TaskController::class
]);

/*
Cria apenas as rotas definidas
Route::resource('/activities', ActivityController::class)->only([
    'create', 'store', 'delete'
]);

//Cria todas as rotas à exceção das definidas
Route::resource('/activities', ActivityController::class)->except([
    'create', 'store', 'delete'
]);
*/

/*
Numa API não precisamos da função editar ou adicionar, apenas precisamos
de enviar dados JSON, para isso usamos o comando:
php artisan make:controller nameController --api
criando o controlador com os metodos necessários, excluindo o create e edit
*/

/*
Nested Resource Route
Cria rotas com o parent (contact) '/' o controlador que passarmos
neste caso rica contacts/notes/...
Ao adicionar o shalow() permite que tambem existas  rotas sem o parent
neste caso notes/...
*/
Route::resource('/contact.notes', ContactNotesController::class);

//Podemos renomear as rotas
Route::resource('/activities', ActivityController::class)->names([
    'index' => 'activities.all',
    'show' => 'activities.view'
]);

/*
Automaticamente ao criar as rotas da maneira em cima, é assumido o parametro
no singular, ou seja, acitivies/{activity}. Caso queiramos mudar isso temos de
usar o metodo ->parameters()
Route::resource('/activities', ActivityController::class)->parameters([
    'activity' => 'newParamName'
]);
*/
