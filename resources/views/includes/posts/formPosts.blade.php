 <div class="card-body">
     <div>
         @csrf
         @if(isset($post))
         <input type="hidden" name="id" value="{{$post->id}}">
         @endif
         <div class="d-flex mt-2 mx-auto mb-5" style="width:90%;">
             <a href="{{route('index.post')}}" class="button-form" style="text-align:center">
                 Back
             </a>
             <button class="button-form ml-auto" type="submit">Save</button>
         </div>
         <div class="row px-3 mx-auto mb-2">
             <div class="col-sm-10 mx-auto">
                 <div class="form-group{{ $errors->has('slug') ? ' has-danger' : '' }}">
                     <input class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" id="input-slug" type="text" placeholder="{{ __('Slug') }}" value="@if(isset($post->slug)){{$post->slug}} @else{{old('slug')}}@endif" required="true" aria-required="true" />
                     @if ($errors->has('slug'))
                     <span id="slug-error" class="error text-danger" for="input-slug">{{ $errors->first('slug') }}</span>
                     @endif
                 </div>
             </div>
         </div>
         <div class="row px-3 mx-auto mb-2">
             <div class="col-sm-10 mx-auto">
                 <div class="form-group{{ $errors->has('tittle') ? ' has-danger' : '' }}">
                     <input class="form-control{{ $errors->has('tittle') ? ' is-invalid' : '' }}" name="tittle" id="input-tittle" type="text" placeholder="{{ __('Tittle') }}" value="@if(isset($post->tittle)){{$post->tittle}} @else{{old('tittle')}}@endif" required="true" aria-required="true" />
                     @if ($errors->has('tittle'))
                     <span id="tittle-error" class="error text-danger" for="input-tittle">{{ $errors->first('tittle') }}</span>
                     @endif
                 </div>
             </div>
         </div>
         <div class="row px-3 mx-auto mb-2">
             <div class="form-group mx-auto content-editor-posts" style="min-height:800px!important">
                 <textarea class="form-control post-editor d-none" name="content" id="editor">@if(isset($post)){{$post->content}}@endif</textarea>
             </div>
         </div>
     </div>
 </div>