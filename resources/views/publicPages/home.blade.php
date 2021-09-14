@extends('layouts.page_templates.public', ['current_page' => 'home'])

@section('content')

<div class="container-homepage-tittle">
    <h1 class="homepage-tittle">
        {{ $general_settings->webTittle }}
    </h1>
</div>
@include('includes.social_icons.icons')
<section class="container-featured-video d-flex">
    <div class="container-video d-flex">
        @if($general_settings->localVideo == 1)
        <video class="featured-video" autoplay src="{{$general_settings->homeVideo}}" controls="controls"></video>
        @else
        <iframe class="featured-video" src="{{$general_settings->homeVideo}}" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
        @endif
    </div>
</section>
<section>
    <div class="d-flex container-home-articles">
        @foreach($posts as $post)
        <a href="{{ route('public.blog', ['slug' => $post->slug])}}" class="featured-home-article">
            <img class="featured-article-image" src="{{$post->image}}" alt="{{$post->tittle}}">
            <p class="featured-article-tittle">{{$post->tittle}}</p>
        </a>
        @endforeach


    </div>
</section>
@endsection