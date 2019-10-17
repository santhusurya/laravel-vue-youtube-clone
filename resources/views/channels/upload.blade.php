@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <channel-uploads :channel="{{ $channel }}" inline-template>
            <div class="col-md-8">
                <div class="card p-3 d-flex justify-content-center align-items-center">
                    {{-- <div class="card p-3 d-flex justify-content-center align-items-center" v-if="!selected"> --}}

                    <svg onclick="document.getElementById('video-files').click()" width="70px" height="70px"
                        version="1.1" id="YouTube_Icon" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1024 721"
                        enable-background="new 0 0 1024 721" xml:space="preserve">
                        <path id="Triangle" fill="#FFFFFF" d="M407,493l276-143L407,206V493z" />
                        <path id="The_Sharpness" opacity="0.12" fill="#420000"
                            d="M407,206l242,161.6l34-17.6L407,206z" />
                        <g id="Lozenge">
                            <g>

                                <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="512.5" y1="719.7"
                                    x2="512.5" y2="1.2" gradientTransform="matrix(1 0 0 -1 0 721)">
                                    <stop offset="0" style="stop-color:#E52D27" />
                                    <stop offset="1" style="stop-color:#BF171D" />
                                </linearGradient>
                                <path fill="url(#SVGID_1_)" d="M1013,156.3c0,0-10-70.4-40.6-101.4C933.6,14.2,890,14,870.1,11.6C727.1,1.3,512.7,1.3,512.7,1.3
            			h-0.4c0,0-214.4,0-357.4,10.3C135,14,91.4,14.2,52.6,54.9C22,85.9,12,156.3,12,156.3S1.8,238.9,1.8,321.6v77.5
            			C1.8,481.8,12,564.4,12,564.4s10,70.4,40.6,101.4c38.9,40.7,89.9,39.4,112.6,43.7c81.7,7.8,347.3,10.3,347.3,10.3
            			s214.6-0.3,357.6-10.7c20-2.4,63.5-2.6,102.3-43.3c30.6-31,40.6-101.4,40.6-101.4s10.2-82.7,10.2-165.3v-77.5
            			C1023.2,238.9,1013,156.3,1013,156.3z M407,493V206l276,144L407,493z" />
                            </g>
                        </g>
                    </svg>

                    <p class="text-center">Upload Videos</p>

                    <input multiple type="file" ref="videos" id="video-files" style="display: none" @change="upload">
                </div>

                <div class="card p-3 my-4" v-if="selected"  v-else>
                    {{-- <div class="card p-3" v-else> --}}
                    <div class="my-2 card card-body" v-for="video in videos">
                        <div class="progress mb-3">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                :style="{ width: `${video.percentage || progress[video.name]}%` }" aria-valuenow="50" aria-valuemin="0"
                                aria-valuemax="100">
                                @{{ video.percentage ? video.percentage === 100 ? 'Video Processing Completed' : 'Processing' : 'Uploading'}}


                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div v-if="!video.thumbnail" class="d-flex justify-content-center align-items-center"
                                    style="height: 180px; color:white; font-size: 18px; background: #808080">
                                    Loading Thumbnail

                                </div>

                                <img v-else :src="video.thumbnail" style="width: 100%" alt="">

                            </div>
                            <div class="col-md-4">
                                <a v-if="video.percentage && video.percentage === 100" :href="`/videos/${video.id}`" target="_blank">
                                    @{{ video.title}}
                                    @{{ selected = false}}
                                </a>
                                <h4 v-else class="text-center">
                                    @{{ video.title || video.name }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </channel-uploads>
    </div>
</div>
@endsection
