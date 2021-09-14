@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Users List')])


@section('content')

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Users</h4>
            <p class="card-category"> Here you can manage users</p>
          </div>
          <div class="card-body px-4">
            <div class="row">
              <div class="col-12 text-right">
                <a href="{{route('create.user')}}" class="btn btn-sm btn-primary">Add user</a>
              </div>
            </div>
            <div class="table-responsive px-3">
              <table class="table">
                <thead class=" text-primary">
                  <tr>
                    <th>
                      Name
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      Role
                    </th>
                    <th>
                      Created
                    </th>
                    <th class="text-right">
                      Actions
                    </th>
                  </tr>
                </thead>
                <tbody id="table-body">
                  @include('includes.users.usersTable')

                </tbody>
              </table>
              <div class="float-right mt-4">
                {{ $users->links() }}

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