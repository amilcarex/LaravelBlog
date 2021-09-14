@extends('layouts.app', ['activePage' => 'edit-category', 'titlePage' => __('Edit Category')])

@section('content')
<div class="content">

    <div class="col-md-10 mx-auto">
        <div class="card pb-3">
            <div class="card-header-icon">
                <div class="card-icon icons-card">
                    <i class="material-icons">content_paste</i>
                </div>
            </div>

            <form action="{{route('update.category')}}" method="post" autocomplete="off" class="form-horizontal col-md-12">
            @method('patch')    
            @include('includes.categories.formCategories')
            </form>
        </div>
    </div>
</div>
@endsection