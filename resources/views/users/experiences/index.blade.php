@extends('layouts.app', ['activePage' => 'experience-management', 'titlePage' => __('Experiences List')])


@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Experiences</h4>
                        <p class="card-category"> Here you can manage experiences</p>
                    </div>
                    <div class="card-body px-4">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('add.user.experience', ['id' => auth()->user()->id])}}" class="btn btn-sm btn-primary">Add Experience</a>
                            </div>
                        </div>
                        <div class="table-responsive px-3">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Logo
                                        </th>
                                        <th>
                                            Company
                                        </th>
                                        <th>
                                            Occupation
                                        </th>
                                        <th>
                                            From
                                        </th>
                                        <th>
                                            To
                                        </th>
                                        <th class="text-right">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @include('includes.users.experiences.experiencesUsersTable')

                                </tbody>
                            </table>
                            <div class="float-right mt-4">
                            {{ $experiences->links() }}
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection