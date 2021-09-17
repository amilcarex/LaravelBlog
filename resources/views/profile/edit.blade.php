@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('User Profile')])

@section('content')

@if(session('error') && session('error') == 'main_account')
<div id="main_account" class="d-none"></div>
@endif
@if(session('error') && session('error') == 'only_admin')
<div id="only_admin" class="d-none"></div>
@endif
@if(session('success') && session('success') == 'edited')
<div id="edited" class="d-none"></div>
@endif
<div class="content container-users-edit">
  <div class="container-fluid">
    <div class="d-flex col-md-12 mx-auto container-profile-edit">
      <div class="row col-md-8 container-profile-info">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal d-flex">
            @csrf
            @method('put')
            @include('layouts.users.form-profile')
          </form>
        </div>
      </div>

      <!-- Card User Preview -->
      <div class="col-md-4">
        <div class="">
          <div class="card py-2">
            <div class="card-header container-image-card">
              <img src="@if(auth()->user()->image != null) {{auth()->user()->image}} @else https://via.placeholder.com/150  @endif" alt="" class="image-profile-card">
            </div>
            <div class="card-body">
              @if(auth()->user()->name != null)
              <p class="hierarchy-card text-card">
                {{auth()->user()->hierarchy}}
              </p>
              @endif
              <p class="name-card text-card">
                {{auth()->user()->name}}
              </p>
              <p class="description-card text-card">
                {{auth()->user()->description}}
              </p>
            </div>
            <div class="card-footer">
            </div>
          </div>
          <div class="container-select-profile-image">
            <div class="card py-2">
              <div class="card-header container-image-card" id="button-select-image" style="cursor:pointer">
                <p class="select-image-profile">Select Image</p>
                <img src="@if(auth()->user()->image != null) {{auth()->user()->image}} @else https://via.placeholder.com/150  @endif" alt="test" id="image-profile-card" class="image-profile-card profile">
              </div>

              <div class="py-4">
                <form method="post" action="{{route('update.profile.image.user')}}">
                  @csrf
                  @method('patch')
                  <input id="image" name="image" type="hidden" class="d-none" value="@if(isset($user->image)) {{ $user->image }} @else {{ old('image') }} @endif">
                  <div class="d-flex mt-2">
                    <button class="button-select-image mx-auto">Load Image</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>



      </div>


    </div>

    <!-- Password -->
    <div class="d-flex col-md-12 mx-auto">
      <div class="row col-md-8 password-profile">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
            @csrf
            @method('put')
            @include('layouts.users.form-password')
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="d-none">
  <textarea id="editor" class="d-none"></textarea>
</div>
@endsection