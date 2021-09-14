@if(count($posts) > 0)
 @foreach($posts as $post)
 <div class="div-container-posts" id="post-to-article" post="{{$post->id}}" slug="{{$post->slug}}">
     <div class="d-flex container-post">
         <div class="container-post-image">
             <img class="blog-post-image" src="{{ $post->image}}" alt="{{$post->tittle}}" />
         </div>
         <div class="container-post-title">
             <h5 class="blog-post-tittle">{{$post->tittle}}</h5>
             <p class="blog-post-updated">{{ date('Y-m-d', strtotime($post->updated_at)) }}</p>
             <p class="blog-post-categories" style="margin:0; padding:0;">
                 @foreach($post->categories as $category_post)
                 @if($category_post->name != 'Uncategorized')
                 <span class="blog-post-category">
                     {{ $category_post->name}}
                 </span>
                 @endif
                 @endforeach
             </p>
         </div>
     </div>

 </div>
 @endforeach

 @endif