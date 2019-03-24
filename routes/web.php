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

// Backend
Route::group(['prefix' => 'admin'], function() {

    $exceptShow = ['except' => [ 'show' ] ];

    Route::get('/dashboard', 'Backend\DashboardController@index')->name('home');

    Route::get('/news', 'Backend\ArticleController@index');
    Route::resource('/articles', 'Backend\ArticleController');
    Route::resource('/games', 'Backend\GameController', $exceptShow);
    Route::resource('/platforms', 'Backend\PlatformController', $exceptShow);
    Route::resource('/publishers', 'Backend\PublisherController', $exceptShow);
    Route::resource('/users', 'Backend\UserController');
    Route::resource('/pages', 'Backend\PageController')->parameters([
        'pages' => 'admin_pages'
    ]);
    // Crawled news
    Route::get('/news/incoming', 'Backend\RSSCrawlerController@index');
    Route::get('/feed/{rssfeed}/edit', 'Backend\RSSCrawlerController@edit');
    Route::patch('/feed/{rssfeed}', 'Backend\RSSCrawlerController@update');
    Route::delete('/feed/{rssfeed}', 'Backend\RSSCrawlerController@destroy');

});

// Sitemap
Route::get('/sitemap.xml', 'SitemapController@index');
Route::get('/sitemap', 'SitemapController@index');
Route::get('/sitemap/articles', 'SitemapController@articles');
Route::get('/sitemap/platforms', 'SitemapController@platforms');
Route::get('/sitemap/games', 'SitemapController@games');
Route::get('/sitemap/pages', 'SitemapController@pages');
Route::get('/rss', 'SitemapController@rss');

// Articles
Route::get('/news', 'ArticleController@index');
Route::get('/article/{article}', 'ArticleController@show');

// Publishers
Route::get('/publishers', 'PublisherController@index');
Route::get('/publishers/{publisher}', 'PublisherController@show');

// Developers
Route::get('/developers', 'DeveloperController@index');
Route::get('/developers/{developer}', 'DeveloperController@show');

// Platforms
Route::get('/platforms', 'PlatformController@index');
Route::get('/platforms/{platform}', 'PlatformController@show');

// Crawler
//Route::get('/crawler', 'RSSCrawlerController@index');
Route::get('/crawler/removeDuplicates', 'RSSCrawlerController@removeDuplicates');
Route::get('/crawler/removeOldNews', 'RSSCrawlerController@removeOldNews');
Route::get('/crawler/crawl', 'RSSCrawlerController@crawl');
Route::get('/crawler/gametitles', 'RSSCrawlerController@getGameTitles');
Route::post('crawler/delete/{id}', 'RSSCrawlerController@remove_from_index');

// Games
Route::get('/games/list', 'GameController@listed');
Route::get('/games/upcoming', 'GameController@upcoming');
Route::resource('/games', 'GameController');

// Authentication
Auth::routes();
Route::get('/validate', 'Auth\ActivateController@index');
// Other pages
Route::get('/', 'PageController@home');
Route::get('/pages', 'PageController@index');
// Very last route for catching all pages
Route::get('/{page}', 'PageController@show');
