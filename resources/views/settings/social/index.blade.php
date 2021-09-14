@extends('layouts.app', ['activePage' => 'social-settings', 'titlePage' => __('Social Settings')])

@section('content')
<div class="content">
    <div class="col-md-10 mx-auto">
        <div class="card pb-3">
            <div class="card-header-icon">
                <div class="card-icon icons-card">
                    <i class="material-icons">settings</i>
                </div>
            </div>

            <form action="{{route('update.social.settings')}}" method="post" autocomplete="off" class="form-horizontal col-md-12 mt-4">
                @method('patch')
                @csrf
                @include('includes.settings.social.form')

            </form>
        </div>
    </div>
</div>
@endsection