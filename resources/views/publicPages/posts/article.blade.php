@if(isset($post))
<div class="article-details">
    <div class="container-article-tittle">
        <h1 class="article-tittle">{{$post->tittle}}</h1>
        <p class="article-updated">{{date('Y-m-d', strtotime($post->updated_at))}}</p>
    </div>
    <div class="container-article-image">
        <img class="article-image" src="{{$post->image}}" alt="{{$post->tittle}}" />
    </div>
    <div class="container-article-content">
        <div class="article-content" id="article-content">
            {!! $post->content !!}
        </div>
    </div>
</div>
@endif