@extends('layouts.app', ['activePage' => 'edit-task', 'titlePage' => __('Edit Task')])

@section('content')
<div class="content">

    <div class="col-md-10 mx-auto">
        <div class="card pb-3">
            <div class="card-header-icon">
                <div class="card-icon icons-card">
                    <i class="material-icons">content_paste</i>
                </div>
            </div>

            <form action="{{route('update.task')}}" method="post" autocomplete="off" class="form-horizontal col-md-12">

                @method('patch')
                @include('includes.tasks.formTasks')

            </form>
        </div>
    </div>
</div>
@endsection