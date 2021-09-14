@extends('layouts.page_templates.public', ['current_page' => 'about'])

@section('content')


@include('includes.social_icons.icons', ['current_page' => 'about'])

@foreach($users as $user)
<section class="about-user-container d-flex">
    <div class="container-div-about content-user">
        <div class="flip-container">
            <div class="content-user-flip" id="content-user-flip">
                <div class="front">
                    <div class="card md-card-profile">
                        <div class="md-card-avatar about">
                            <img class="image-profile-card" style="height: 200px; width: 200px" src="{{$user->image}}" />
                        </div>
                        <div class="card-body container-body-about">
                            <h6 class="category">{{ $user->hierarchy }}</h6>
                            <h4 class="card-tittle">{{ $user->name }}</h4>
                            <p class="card-description">
                                {{ $user->description }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="back">
                    <div class="card md-card-profile">
                        <div class="md-card-avatar about">
                            <img class="image-profile-card" style="height: 200px; width: 200px" src="{{$user->image}}" />
                        </div>
                        <div class="card-body container-body-about">
                            <h6 class="tittle-skills">Skills</h6>

                            @foreach($user->skills as $skill)
                            <p class="user-skill">
                                * {{$skill}}
                            </p>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination-about">
            {{$users->links()}}
        </div>
    </div>
    <div class="container-div-about content-experience">
        @foreach($user->experience as $experience)
        <div class="div-container-experience">
            <div class="d-flex">
                <div class="container-experience company-logo-container">
                    <img src="{{$experience->logo}}" alt="{{$experience->company}}" class="company-logo" />
                </div>
                <div class="container-experience container-experience-details">
                    <p class="company-name">{{ $experience->company }}</p>
                    <p class="occupation-name">{{ $experience->occupation }}</p>
                    <p class="from-to">
                        <span>{{ $experience->from }}</span> - <span>{{ $experience->to }}</span>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endforeach

@endsection