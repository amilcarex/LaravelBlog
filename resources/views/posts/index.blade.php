@extends('layouts.app', ['activePage' => 'posts-management', 'titlePage' => __('Posts List')])


@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Posts</h4>
                        <p class="card-category"> Here you can manage posts</p>
                    </div>
                    <div class="card-body px-4">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('create.post')}}" class="btn btn-sm btn-primary">Add Post</a>
                            </div>
                        </div>
                        <div class="table-responsive px-3">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Tittle
                                        </th>
                                        <th>
                                            Author
                                        </th>
                                        <th>
                                            Visibility
                                        </th>
                                        <th>
                                            Updated
                                        </th>
                                        <th class="text-right">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @include('includes.posts.postsTable')

                                </tbody>
                            </table>
                            <div class="float-right mt-4">
                                {{ $posts->links() }}

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