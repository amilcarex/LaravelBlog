 <div class="card-body">
     <div>
         @csrf
         @if(isset($category))
         <input type="hidden" name="id" value="{{$category->id}}">
         @endif
         <div class="row px-3 mx-auto mb-2">
             <div class="col-sm-10 mx-auto">
                 <div class="form-group{{ $errors->has('slug') ? ' has-danger' : '' }}">
                     <input class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" id="input-slug" type="text" placeholder="{{ __('Slug') }}" value="@if(isset($category->slug)){{$category->slug}} @else{{old('slug')}}@endif" required="true" aria-required="true" />
                     @if ($errors->has('slug'))
                     <span id="slug-error" class="error text-danger" for="input-slug">{{ $errors->first('slug') }}</span>
                     @endif
                 </div>
             </div>
         </div>
         <div class="row px-3 mx-auto mb-2">
             <div class="col-sm-10 mx-auto">
                 <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                     <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="@if(isset($category->name)){{$category->name}} @else{{old('name')}}@endif" required="true" aria-required="true" />
                     @if ($errors->has('name'))
                     <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                     @endif
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="card-footer">
     <div class="d-flex mt-2 mx-auto" style="width:80%;">
         <a href="{{route('index.category')}}" class="button-form" style="text-align:center">
             Back
         </a>
         <button class="button-form ml-auto" type="submit">Save</button>
     </div>
 </div>