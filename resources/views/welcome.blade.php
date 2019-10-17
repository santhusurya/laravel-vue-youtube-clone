@extends('layouts.app')

@section('content')
<?php
    $videosList = App\Video::latest()->paginate(10);
    $videosListCount = $videosList->count();
    $landingVideo = App\Video::where('percentage', '=', 100 )->latest()->first();
    $totalVideosCount = App\Video::count();
?>

<div class="container">
    <div class="row justify-content-center">

        @if($videosListCount !== 0)
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Search Videos & Channels on {{ config('app.name', 'Laratube') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="">
                        <input type="text" class="form-control" placeholder="Search Videos & Channels" name="search">
                    </form>


                </div>
            </div>

            @if($channels->count() !== 0)
            <div class="card mt-3">
                <div class="card-header">
                    Search Result for Channels on {{ config('app.name', 'Laratube') }}
                </div>
                <div class="card-body border-bottom">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>Name</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($channels as $channel)
                            <tr>
                                <td>{!! $channel->name !!}</td>

                                <td>
                                    <a href="{{route('channels.show', $channel->id)}}" class="btn btn-sm btn-info"
                                        target="_blank">View Channel</a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                    <div class="row justify-content-center">
                        {{ $channels->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
            @endif

            @if($videos->count() !== 0)
            <div class="card mt-3">
                <div class="card-header">
                    Search Result for Videos on {{ config('app.name', 'Laratube') }}
                </div>
                <div class="card-body border-bottom">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <th>Name</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($videos as $video)
                            <tr>
                                <td>{!! $video->title !!}</td>

                                <td>
                                    <a href="{{route('videos.show', $video->id)}}" class="btn btn-sm btn-info"
                                        target="_blank">View
                                        Video</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row justify-content-center">
                        {{ $videos->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
            @endif

            <div class="card  my-4">
                <div class="card-header">
                    Latest Video on {{ config('app.name', 'Laratube') }}
                </div>
                <div class="card-body">
                    <video id='video' class='video-js' controls preload='auto' width='100%' height='420'
                        data-setup='{}'>
                        <source src=' {{ asset(Storage::url("videos/{$landingVideo->id}/{$landingVideo->id}.m3u8")) }}'
                            type='application/x-mpegURL'>
                    </video>

                    <div class="card card-body">
                        <h5>
                            {!! $landingVideo->title !!}
                        </h5>
                        <p class="mb-0">{{ $landingVideo->created_at->toFormattedDateString() }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    All Videos Uploaded on {{ config('app.name', 'Laratube') }}
                </div>
                <div class="card-body">
                    @if($videosListCount !== 0)
                    <table class="table my-0 table-striped table-bordered table-responsive">
                        <thead>
                            <th>Video</th>
                            <th>Title</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th>Uploaded</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach($videosList as $video)
                            <tr>
                                <td><img src="{{ $video->thumbnail}}" alt="" width="60" height="60"></td>
                                <td>{{ $video->title}}</td>
                                <td>{{ $video->views}}</td>
                                <td>{{ $video->percentage === 100 ? 'LIVE' : 'PROCESSING' }}</td>
                                <td>{{ $video->created_at->toFormattedDateString() }}</td>
                                <td>
                                    @if($video->percentage === 100)
                                    <a href="{{ route('videos.show', $video->id)}}" class="btn btn-sm btn-info"
                                        target="_blank">View</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row justify-content-center mt-4">

                        <h5>Showing {{ $videosListCount}} {{ Str::plural('video', $videosListCount) }} of total
                            {{ $totalVideosCount }} {{ Str::plural('video', $totalVideosCount) }}</h5>
                    </div>
                    <div class="row justify-content-center mt-4">
                        {{ $videosList->render() }}
                    </div>
                    @else
                    <h5>No Videos Yet!!</h5>
                    @endif
                </div>

            </div>
        </div>




        @endif



    </div>
</div>
@endsection

@section('styles')
<link href="/css/video-js.css" rel="stylesheet">
<style>
    .video-js {
        width: 100%;
    }
</style>
@endsection

@section('scripts')
<script src='/js/video.js'></script>
<script>
    window.CURRENT_VIDEO = '{{ $video->id }}'
</script>
<script src="{{ asset('js/player.js')}}"></script>

@endsection
