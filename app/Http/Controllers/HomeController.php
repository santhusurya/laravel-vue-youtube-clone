<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\Video;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $search = request()->search;
        $videos = collect();
        $channels = collect();

        if ($search) {
            $videos = Video::where('title', 'LIKE', "%{$search}%")->orwhere('description', 'LIKE', "%{$search}%")->paginate(5, ['*'], 'video_page');
            $channels = Channel::where('name', 'LIKE', "%{$search}%")->orwhere('description', 'LIKE', "%{$search}%")->paginate(5, ['*'], 'channel_page');
        }

        return view('home')->with([
            'videos' => $videos,
            'channels' => $channels
        ]);
    }
}
