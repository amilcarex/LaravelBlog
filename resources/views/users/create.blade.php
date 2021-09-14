@extends('layouts.app', ['activePage' => 'create-user', 'titlePage' => __('Create User')])

@section('content')
<div class="content container-users-edit">
    <div class="container-fluid">
        <div class="d-flex mx-auto">
            <div class="row col-md-12">
                   
                    
                        @include('includes.users.formUsers')
            </div>
        </div>
    </div>

</div>
@endsection