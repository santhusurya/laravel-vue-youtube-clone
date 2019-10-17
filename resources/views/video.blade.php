@extends('layouts.app')

@section('content')
<div class="container" v-cloak>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if($video->editable())
            <form action="{{ route('videos.update', $video->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @endif
                    <div class="card-header">{!! $video->title !!}</div>

                    <div class="card-body">
                        <video id='video' class='video-js' controls preload='auto' width='680' height='420'
                            data-setup='{}'>
                            <source src=' {{ asset(Storage::url("videos/{$video->id}/{$video->id}.m3u8")) }}'
                                type='application/x-mpegURL'>
                        </video>
                        <div class="justify-content-between align-items-center">
                            <div class="row mt-3">
                                <div class="col-md-9">
                                    <h4 class="">
                                        @if($video->editable())
                                        <input type="text" class="form-control" name="title"
                                            value="{!! $video->title !!}">
                                        @else
                                        {!! $video->title !!}
                                        @endif
                                    </h4>
                                    {{ $video->views }} {{ Str::plural('view', $video->views) }}
                                </div>



                                <div class="col-md-3">
                                    <votes :default_votes='{{$video->votes}}' entity_id="{{ $video->id }}"
                                        entity_owner="{{ $video->channel->user_id }}"></votes>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        @if($video->editable())

                                        <textarea name="description" cols="30" rows="4"
                                            class="form-control">{!! $video->description!!}</textarea>
                                        <div class="text-right mt-3">
                                            <button type="submit" class="btn btn-info btn-sm">Update Video
                                                Details</button>
                                        </div>
                                        @else
                                        {!! $video->description!!}
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <div class="media">
                                <img src="https://picsum.photos/id/1/200/300" alt="" width="50" height="50"
                                    class="rounded-circle mr-2">
                                <div class="media-body ml-2">
                                    <h5 class="my-0">
                                        {!! $video->channel->name !!}
                                    </h5>
                                    <span class="small">Published on
                                        {{ $video->created_at->toFormattedDateString() }}</span>
                                </div>

                            </div>
                            <div class="text-center">
                                <subscribe-button :channel="{{ $video->channel }}"
                                    :initial-subscriptions="{{ $video->channel->subscriptions }}" />
                            </div>
                        </div>
                    </div>
                    @if($video->editable())
                </form>
                @endif
            </div>
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
