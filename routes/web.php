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

use App\Http\Controllers\UploadVideoController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VoteController;

use App\Video;
use App\Channel;

Route::get(
    '/',
    function () {

        $search = request()->search;
        $videos = collect();
        $channels = collect();

        if ($search) {
            $videos = Video::where('title', 'LIKE', "%{$search}%")->orwhere('description', 'LIKE', "%{$search}%")->paginate(5, ['*'], 'video_page');
            $channels = Channel::where('name', 'LIKE', "%{$search}%")->orwhere('description', 'LIKE', "%{$search}%")->paginate(5, ['*'], 'channel_page');
        }

        return view('welcome')->with([
            'videos' => $videos,
            'channels' => $channels
        ]);
    }
);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('channels', 'ChannelController');

Route::get('videos/{video}', [VideoController::class, 'show'])->name('videos.show');

Route::put('videos/{video}', [VideoController::class, 'updateViews']);

Route::put('videos/{video}/update', [VideoController::class, 'update'])->middleware(['auth'])->name('videos.update');

Route::middleware(['auth'])->group(function () {
    Route::post('votes/{video}/{type}', [VoteController::class, 'vote']);

    Route::resource('channels/{channel}/subscriptions', 'SubscriptionController')->only(['store', 'destroy']);

    Route::get('channels/{channel}/videos', [UploadVideoController::class, 'index'])->name('channel.upload');

    Route::post('channels/{channel}/videos', [UploadVideoController::class, 'store']);

});


