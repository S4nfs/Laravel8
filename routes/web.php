<?php

use App\Http\Controllers\Clonedatabse;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\CustomController;
use App\Http\Controllers\FormSubmit;
use App\Http\Controllers\KroConnect;
use App\Http\Controllers\WorldWideConnection;
use App\Http\Controllers\MyfetchedData;
use App\Http\Controllers\Formlogin;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Crud;
use App\Http\Controllers\QueryBuilder;
use League\CommonMark\Node\Query;
use App\Http\Controllers\LearnAccessorsMutators;
use App\Http\Controllers\OnetoOne;
use App\Http\Controllers\RouteModelBinding;
use App\Mail\SampleMail;

use function PHPUnit\Framework\fileExists;

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

//3 methods to route:
Route::get('/', function () {                                       //[1]using function
    return view('posts');
});
Route::get('users/{customer}', [Usercontroller::class, 'show']);    //[2]from controller [must import above]
// Route::view("url", "file");                                      //[3]from view

//Wildcards-------------------------------------------------------------------------------------------------------
Route::get('/posts/{post}', function ($slug) {
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    if (!file_exists($path)) {
        abort(404);
    }
    $p = file_get_contents($path);
    return view('post', ['data' => $p]);
});



//---------------------------------------------------------------------------------------------------------------
Route::view('about', 'about');  //with header component
Route::get('custom', [CustomController::class, 'loadview']); //custom.blade

// MIDDLEWARE-----------------------------------------------------------------------------------------------------
Route::view('noaccess', 'noaccess'); //goup middleware
Route::group(['middleware' => ['protectPage']], function () { //middleware ageCheck
    Route::view('access', 'access');
});
Route::view('access1', 'access1')->middleware('ageCheckerRoute'); //route middleware

// DATABASE-------------------------------------------------------------------------------------------------------
Route::get('createconnection', [WorldWideConnection::class, 'dataq']); //database connection with class
Route::get('/connect', [KroConnect::class, 'getDatabase']); //database connection with model

//HTTP Client-----------------------------------------------------------------------------------------------------
Route::get('fetch', [MyfetchedData::class, 'fdata']); //fetch apis

//HTTP methods-----------------------------------------------------------------------------------------------------
Route::post('formlogin', [Formlogin::class, 'testrequest']); //post form data

Route::get('/employeelogin', function () {
    if (session()->has('usersession')) {
        return redirect('profile');
    }
    return redirect('employeelogin');
});
Route::view('/profile', 'profile');

Route::view('employeelogin', 'employeelogin');

Route::get('/logout', function () {
    if (session()->has('usersession')) {
        session()->pull('usersession', null);
    }
    return redirect('employeelogin');
});


//File Upload-----------------------------------------------------------------------------------------------------
Route::view('upload', 'upload');
Route::post('uploadFile', [UploadController::class, 'uploadER']);

//Language--------------------------------------------------------------------------------------------------------
Route::get('/lang/{lang}', function ($language) {
    App::setlocale($language);
    return view('lang');
});

//CRUD-------------------------------------------------------------------------------------------------------------
Route::view('login', 'submit'); //form view
Route::post('add', [Crud::class, 'registerData']); //Create
Route::get('myuser', [Crud::class, 'getUser']); // Read
Route::get('/edit{id}', [Crud::class, 'showWhatToUpdate']); //Update
Route::post('/edit', [Crud::class, 'updateData']);
Route::get('/delete{id}', [Crud::class, 'deleteUser']); //Delete

//QUERY BUILDER-----------------------------------------------------------------------------------------------------
Route::get('myquerybuilder', [QueryBuilder::class, 'operation']);

//Accessors & Mutators----------------------------------------------------------------------------------------------
Route::get('accessors', [LearnAccessorsMutators::class, 'accessorss']);
Route::get('mutators', [LearnAccessorsMutators::class, 'mutatorss']);

//Relationship with tables members,comanies,devices-----------------------------------------------------------------
Route::get('/o', [OnetoOne::class, 'onetoone']);    //OnetoOne
Route::get('/om', [OnetoOne::class, 'onetomany']);

//Route Model Binding-----------------------------------------------------------------------------------------------
Route::get('rbm/{mykey}', [RouteModelBinding::class, 'rbm']); //fetch using unique id
Route::get('rbm/{mykey:devicename}', [RouteModelBinding::class, 'rbm']);  //fetch using name

//Mail--------------------------------------------------------------------------------------------------------------
ROute::get('/mail', function () {
    return new SampleMail();
});

//APIs---------------------------------------------------------------------------------------------------------------

//Connect Multiple Databse-----------------------------------------------------------------------------------------------------
Route::get('/db2', [Clonedatabse::class, 'list']);  //controller OR model