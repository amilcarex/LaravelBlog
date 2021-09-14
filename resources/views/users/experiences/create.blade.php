@extends('layouts.app', ['activePage' => 'add-experience', 'titlePage' => __('Add Experience')])

@section('content')
<div class="content">

    <div class="col-md-10 mx-auto">
        <div class="card pb-3">
            <div class="card-header-icon">
                <div class="card-icon icons-card">
                    <i class="material-icons">content_paste</i>
                </div>
            </div>

            <form action="{{route('store.user.experience')}}" method="post" autocomplete="off" class="form-horizontal col-md-12">
                @include('includes.users.experiences.formExperiencesUsers')
            </form>
        </div>
    </div>
</div>
@endsection