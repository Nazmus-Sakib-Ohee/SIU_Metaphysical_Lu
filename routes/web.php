<?php

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




Route::get('/','HomeController@index')->name('homepage');
Route::get('/home/idea/{id}','HomeController@fullIdea')->name('fullIdea');
Route::get('/home/search/','HomeController@search')->name('searchIdea');
Route::get('/home/sortby/{query}','HomeController@sort')->name('sortbyIdea');



Route::Auth();

Route::group(['middleware' => ['auth']], function () {
        Route::get('/logout', 'DashboardController@getLogout')->name('logout');

        Route::get('/profile','viewController@viewProfile')->name('profile');
        Route::get('/profile/sortby/{query}','viewController@sortProfile')->name('sortProfile');
        Route::get('/analytics','viewController@analytics')->name('analytics');
        Route::get('/wish-list','viewController@allWish')->name('allWish');

        Route::get('/wish-list/search/','viewController@searchWish')->name('searchWish');
        Route::get('/wish-list/sortby/{query}','viewController@sortbyWish')->name('sortbyWish');

        Route::get('/add-to-wish/{id}','viewController@addWish')->name('addWish');
        Route::get('/remove-from-wish/{id}','viewController@removeWish')->name('removeWish');

        Route::post('/up-vote','IdeaController@upVote')->name('upVote');
        Route::post('/down-vote','IdeaController@downVote')->name('downVote');

        Route::get('/submit-idea','viewController@submitIdea')->name('submitIdea');
        Route::post('/submit-idea','IdeaController@storeIdea')->name('storeIdea');

        Route::post('/comment/{id}','viewController@comment')->name('comment');


Route::group(['middleware' => ['CheckAdmin']], function () {


        Route::get('/dashboard','DashboardController@index')->name('dashboard');  
        Route::get('/dashboard/{year}','DashboardController@analytics')->name('dashboard-analytics');  

        Route::get('/top-voter-list','IdeaController@topVoter')->name('topVoter');
        Route::get('/top-idea-submitters','IdeaController@topIdeaSubmitters')->name('topIdeaSubmitters');

        Route::prefix('dashboard')->group(function () {

            //User Management Start
                Route::prefix('users')->name('users.')->namespace('Users')->group(function () {

                    Route::get('/add','UserController@index')->name('add');
                    Route::post('/add','UserController@store')->name('store');
                    Route::get('/all','UserController@show')->name('all');
                    Route::get('/search','UserController@search')->name('search');
                    Route::get('/edit/{id}','UserController@edit')->name('edit');
                    Route::post('/edit/{id}','UserController@update')->name('update');
                    Route::post('/delete','UserController@destroy')->name('delete');

                });
            //User MAnagement END

            //Roles Management Start
                Route::prefix('roles')->name('roles.')->namespace('Rules')->group(function () {

                    Route::get('/add','RolesController@index')->name('add');
                    Route::post('/add','RolesController@store')->name('store');
                    Route::get('/all','RolesController@show')->name('all');
                    Route::get('/search','RolesController@search')->name('search');
                    Route::get('/edit/{id}','RolesController@edit')->name('edit');
                    Route::post('/edit/{id}','RolesController@update')->name('update');
                    Route::post('/delete','RolesController@destroy')->name('delete');

                });
            //Roles MAnagement END  


            //Idea MAnagement Start
                 Route::prefix('idea')->name('idea.')->group(function () {
                    Route::get('/all','IdeaController@show')->name('all');
                    Route::get('/search','IdeaController@search')->name('search');
                    Route::get('/sortby/{query}','IdeaController@sort')->name('sort');
                    Route::get('/view/{id}','IdeaController@view')->name('view');
                    Route::post('/status','IdeaController@status')->name('status');
                    Route::post('/delete','IdeaController@destroy')->name('delete');

                });
            //Idea MAnagement END  

        });
          });

    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
