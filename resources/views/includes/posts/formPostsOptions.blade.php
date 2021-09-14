<div class="card-body">
    <div class="d-flex container-post-options mx-auto">
        <div class="container-post-categories  container-option">
            <p class="tittle-options-post">Select Category</p>
            <div class="container-categories mx-auto">
                <ul class="list-categories">
                    @foreach($categories as $category)

                    <li><input type="checkbox" @if(isset($category_check)) @foreach($category_check as $checked) @if($checked->id==$category->id) checked @endif @endforeach @endif class="check-category" name="categories[{{$category->name}}]" value="{{$category->id}}"> <label for="">{{ $category->name }}</label></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="container-post-permissions container-option">
            <p class="tittle-options-post">Permissions</p>
            <div class="container-visibilities mb-5">
                <select name="visibility" id="visibility" class="post-visibilities mx-auto col-sm-8 form-control">
                    @foreach($visibilities as $visibility)
                    <option @if(isset($post) && $post->visibility == $visibility->id) selected @endif value="{{$visibility->id}}">{{$visibility->visibility}}</option>
                    @endforeach
                </select>
            </div>
            <div class="container-pinned container-permission d-flex">
                <input type="checkbox" @if(isset($post)) @if($pinned==true) checked @endif @endif class="form-control check-permissions" name="pinned" id="pinned">
                <label for="pinned" class="label-check-permissions">Pin at the top of the blog</label>
            </div>
            <div class="container-restricted container-permission d-flex">
                <input type="checkbox" @if(isset($post)) @if($restricted==true) checked @endif @endif class="form-control check-permissions" name="restricted" id="restricted">
                <label for="restricted" class="label-check-permissions">Restrict Access to content</label>
            </div>

        </div>
        <div class="container-post-image container-option">
            <p class="tittle-options-post">Featured Image</p>
            <div class="container-post-featured-image d-flex">
                <img src="@if(isset($post) && $post->image != null) {{$post->image}}  @else https://via.placeholder.com/150  @endif" alt="" id="select-image" class="featured-post-image" style="margin:0 auto;">
                <input type="hidden" name="image" id="image" value="@if(isset($post)){{$post->image}}@endif">
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="d-flex mt-2 mx-auto" style="width:80%;">
        <a href="{{route('index.post')}}" class="button-form" style="text-align:center">
            Back
        </a>
        <button class="button-form ml-auto" type="submit">Save</button>
    </div>
</div>