@extends('layouts.app', ['activePage' => 'create-category', 'titlePage' => __('Create Category')])

@section('content')
<div class="content">

    <div class="col-md-10 mx-auto">
        <div class="card pb-3">
            <div class="card-header-icon">
                <div class="card-icon icons-card">
                    <i class="material-icons">content_paste</i>
                </div>
            </div>

            <form action="{{route('store.category')}}" method="post" autocomplete="off" class="form-horizontal col-md-12">
                @include('includes.categories.formCategories')
            </form>
        </div>
    </div>
</div>
@endsection