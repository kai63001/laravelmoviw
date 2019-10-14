<?php

Auth::routes();


Route::get('/admin', 'AdminController@index');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/{v_id}/{v_name}', 'HomeController@detail')->name('detail');

Route::get('changePassword','AdminController@showChangePasswordForm');

Route::post('/change','AdminController@changePassword')->name('changePassword');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/admin/find-movie/{name}','AdminController@findmove')->name('findmovie');

Route::post('/admin/get-movie','AdminController@addmovie')->name('addmovie');

Route::get('/admin/searchmovie/{name}','AdminController@findmovie');

Route::get('/play/{url}/run','HomeController@player');

Route::post('/admin/addmovier','AdminController@addmovier')->name('addmovier');

Route::get('/admin/movie/backup/{v_id}','AdminController@addmoviebackup');

Route::post('/admin/movie/addbackup','AdminController@addbackup_movie')->name('addbackup_movie');

Route::get('/admin/movie/delete/{id}','AdminController@delete_movie');

Route::post('/admin/moive/addtags','AdminController@addtags')->name('addtags');

Route::get('/admin/delete/tags/{t_id}','AdminController@deletetags');

Route::get('/admin/find-anime/{name}','AdminController@findanime');

Route::post('/admin/add-anime','AdminController@addanime')->name('addanime');

Route::get('/admin/searchanime/{name}/{ep}','AdminController@searchanime');

Route::get('/player_sugoi/{anime}/play','HomeController@animeplayer');

Route::get('/admin/anime/backup/{a_id}','AdminController@animebackup');

Route::get('/admin/addvideoanime/{v_id}','AdminController@addvideoanime');

Route::post('/admin/addanimebackup','AdminController@addanimebackup')->name('addanimebackup');

Route::get('/watch/{a_id}/{a_name}','HomeController@watch');

Route::get('/วิดีโอทั้งหมด','HomeController@allvideo');

Route::get('/หนังทั้งหมด','HomeController@allmovie');

Route::get('/ซีรีย์ทั้งหมด','HomeController@allseries');

Route::get('/อนิเมะทั้งหมด','HomeController@allanime');

Route::get('/search','HomeController@search')->name('searcher');

Route::get('/admin/search/series/{name}/{ep}','AdminController@search_series');

Route::get('/play-series/{url}/play','HomeController@play_series');

Route::get('/admin/find-series/{name}','AdminController@findseries');

Route::post('/admin/add/series','AdminController@addseries')->name('addseries');

Route::get('/admin/seriesvideo/{id}','AdminController@addvideoSeries');

Route::post('/admin/addseriesep/added','AdminController@addseriesep')->name('addseriesep');

Route::get('/admin/backupfind/{id}','AdminController@backupfind');

Route::get('/admin/edit/ep/{a_id}/{v_id}','AdminController@editep');

Route::post('/admin/edit/ep','AdminController@leteditep')->name('leteditep');

Route::get('/admin/backupep/{a_id}/{v_id}','AdminController@backupep');

Route::get('/admin/backup/edit/{ab_id}/{v_id}','AdminController@backupedit');

Route::post('/admin/leteditbackupep/ep','AdminController@leteditbackupep')->name('leteditbackupep');

Route::get('/admin/delete/ep/{a_id}','AdminController@deleteep');

Route::get('/admin/delete/epbackup/{ab_id}','AdminController@deleteepbackup');

Route::get('/admin/edit/video/{v_id}','AdminController@editvideo');

Route::post('/admin/editvideo/edit','AdminController@editvideoedit')->name('editvideoedit');

Route::get('/admin/allvideo/list','AdminController@allvideo');

Route::get('/admin/allvideo/search','AdminController@allvideosearch')->name('allvideosearch');

Route::get('/admin/stealall/list','AdminController@stealall_list');

Route::get('/tags/video/{name}','HomeController@tags');

Route::post('/admin/setting/dashboard','AdminController@dashboard')->name('dashboard');

Route::post('/admin/setting/advance','AdminController@advance')->name('advance');

Route::get('/admin/steal/animehdzero','AdminController@animehdzero');

Route::get('/admin/steal/animehdzero/{url}','AdminController@animehdzerofind');

Route::get('/kuro-player/embed','HomeController@kuroplayer');

Route::post('/report/video/','HomeController@reportvideo')->name('reportvideo');

Route::get('/admin/show/report','AdminController@reportshow');

Route::get('/admin/edit/report/{v_id}/{r_id}/movie','AdminController@editrerpotmovie');

Route::get('/admin/edit/report/{v_id}/{a_id}/{r_id}/anime','AdminController@editreportanime');

Route::get('/admin/edit/movie/{v_id}','AdminController@editmovie');

Route::post('/admin/edit/start/movie','AdminController@editmovie_start')->name('editmovie_start');

Route::get('admin/steal/imovie','AdminController@stealimovie');

Route::get('admin/steal/imovie/{url}','AdminController@urlimovie');

Route::get('admin/os/setting','AdminController@settingsoption');

Route::post('admin/save/script','AdminController@savescript')->name('savescript');

Route::post('admin/save/ads','AdminController@saveads')->name('saveads');

Route::get('admin/delete/ads/{id}','AdminController@deleteads');

Route::get('admin/auto/addnewep/{v_id}/{v_name}','AdminController@autoaddnewep');

Route::get('admin/auto/fixanime/{v_id}/{v_name}','AdminController@autofixanime');