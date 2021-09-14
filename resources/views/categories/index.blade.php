@extends('layouts.app', ['activePage' => 'categories-management', 'titlePage' => __('Categories List')])


@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Categories</h4>
                        <p class="card-category"> Here you can manage categories</p>
                    </div>
                    <div class="card-body px-4">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{route('create.category')}}" class="btn btn-sm btn-primary">Add Category</a>
                            </div>
                        </div>
                        <div class="table-responsive px-3">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            Slug
                                        </th>
                                        <th>
                                            Name
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
                                    @include('includes.categories.categoriesTable')

                                </tbody>
                            </table>
                            <div class="float-right mt-4">
                                {{ $categories->links() }}

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