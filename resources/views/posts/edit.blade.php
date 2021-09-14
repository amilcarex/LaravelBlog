@extends('layouts.app', ['activePage' => 'edit-post', 'titlePage' => __('Edit Post')])

@section('content')
<div class="content">
    <form action="{{route('update.post')}}" method="post" autocomplete="off" class="form-horizontal col-md-12">
    @method('patch')
        <div class="col-md-11 mx-auto mb-5">
            <div class="card pb-3">
                <div class="card-header-icon">
                    <div class="card-icon icons-card">
                        <i class="material-icons">content_paste</i>
                    </div>
                </div>
    
                @include('includes.posts.formPosts')

            </div>
        </div>

        <div class="col-md-11 mx-auto">
            <div class="card pb-3">
                <div class="card-header-icon">
                    <div class="card-icon icons-card">
                        <i class="material-icons">content_paste</i>
                    </div>
                </div>

                @include('includes.posts.formPostsOptions')

            </div>
        </div>
    </form>
</div>
@endsection