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

// Sitemap
Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('/sitemap', 'SitemapController@index');
Route::get('/sitemap/games', 'SitemapController@games');
Route::get('/sitemap/pages', 'SitemapController@pages');

Route::get('/', 'PageController@home');
Route::get('/pages', 'PageController@index');

// Publishers
Route::get('/publishers', 'PublisherController@index');
Route::get('/publishers/{publisher}', 'PublisherController@show');

// Crawler
Route::get('/crawler/crawl', 'RSSCrawlerController@crawl');
Route::get('/crawler', 'RSSCrawlerController@index');
Route::get('/crawler/gametitles', 'RSSCrawlerController@getGameTitles');

Route::resource('/games', 'GameController');

// Very last route for catching all pages
Route::get('/{page}', 'PageController@show');
