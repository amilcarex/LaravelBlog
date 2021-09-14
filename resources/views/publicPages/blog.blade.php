@extends('layouts.page_templates.public', ['current_page' => 'blog'])

@section('content')


@include('includes.social_icons.icons', ['current_page' => 'blog'])

<section>
    <div class="container-blog d-flex">
        <div class="d-flex container-all-posts" style="flex-direction: column">
            <h1 class="tittle-container-blog">Last Entries</h1>
            <div class="container-filter-blog">
                <label class="select-categories-blog-label"> Categories </label>
                <div class="md-layout-item container-select-categories">
                    <select name="category" class="select-categories-blog" id="category">
                        <option value="">None</option>
                        @foreach($categories as $category)
                        @if($category->name != 'Uncategorized')
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="container-blog-articles" id="container-scroll-posts">
                @include('publicPages.posts.pagination')
            </div>
        </div>
        <div class="container-article-details" id="article-info">
            @include('publicPages.posts.article')
        </div>
    </div>
</section>

@endsection