@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $channel->name }}</div>

                <div class="card-body">

                    @if($channel->editable())
                    <form action="{{ route('channels.update', $channel->id)}}" method="POST"
                        enctype="multipart/form-data" id="updateChannelForm">
                        @csrf

                        @method('PATCH')

                        @endif
                        <div class="form-group row justify-content-center"
                            onclick="document.getElementById('image').click()">
                            <div class="channel-avatar">

                                @if($channel->editable())

                                <div class="channel-avatar-overlay">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="50" height="50"
                                        fill="#000000">
                                        <path
                                            d="M 24.375 4 C 22.578125 4 20.699219 5.421875 19.9375 7.375 L 19.3125 9 L 14 9 L 14 8 C 14 7.445313 13.554688 7 13 7 L 6 7 C 5.445313 7 5 7.445313 5 8 L 5 9.28125 C 2.058594 10.148438 0 12.863281 0 16 L 0 37 C 0 40.859375 3.140625 44 7 44 L 43 44 C 46.859375 44 50 40.859375 50 37 L 50 16 C 50 12.140625 46.859375 9 43 9 L 40.6875 9 L 40.0625 7.375 C 39.300781 5.421875 37.421875 4 35.625 4 Z M 30 13 C 37.167969 13 43 18.832031 43 26 C 43 33.167969 37.167969 39 30 39 C 22.832031 39 17 33.167969 17 26 C 17 18.832031 22.832031 13 30 13 Z M 7 14 C 8.105469 14 9 14.894531 9 16 C 9 17.105469 8.105469 18 7 18 C 5.894531 18 5 17.105469 5 16 C 5 14.894531 5.894531 14 7 14 Z M 30 15 C 23.933594 15 19 19.933594 19 26 C 19 32.066406 23.933594 37 30 37 C 36.066406 37 41 32.066406 41 26 C 41 19.933594 36.066406 15 30 15 Z" />
                                    </svg>
                                </div>

                                @endif

                                <img src="{{ $channel->image() }}" alt="">
                            </div>
                        </div>



                        <div class="form-group">
                            <h4 class="text-center">
                                {{$channel->name}}
                            </h4>

                            <p class="text-center">{{ $channel->description}}</p>

                            <div class="text-center">
                                <subscribe-button inline-template :channel="{{ $channel }}"
                                    :initial-subscriptions="{{ $channel->subscriptions }}">
                                    <button @click="toggleSubscription" class="btn btn-danger">
                                        @{{owner ? '': subscribed ?'Unsubscribe' : 'Subscribe'}}
                                        @{{ count }} @{{ owner ? 'Subscibers' : '' }}
                                    </button>
                                </subscribe-button>
                            </div>
                        </div>



                        @if($channel->editable())
                        <input onchange="document.getElementById('updateChannelForm').submit()" type="file" name="image"
                            id="image" class="d-none">

                        <div class="form-group">
                            <label for="name" class="form-control-label">
                                Name
                            </label>
                            <input type="text" id="name" name="name" value="{{ $channel->name}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-control-label">
                                Description
                            </label>
                            <textarea name="description" id="description" cols="3" rows="3"
                                class="form-control">{{ $channel->description}}</textarea>
                        </div>

                        @if($errors->any())
                        <ul class="list-group mb-3">
                            @foreach ($errors->all() as $error)
                            <li class="list-group-item text-danger">
                                {{$error}}
                            </li>
                            @endforeach
                        </ul>
                        @endif

                        <button class="btn btn-info" type="submit">Update Channel</button>
                        @endif


                        @if($channel->editable())
                    </form>

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
