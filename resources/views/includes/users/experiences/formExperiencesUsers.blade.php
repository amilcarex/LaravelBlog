 <div class="card-body">
     <div>
         @csrf
         @if(isset($experience))
         <input type="hidden" name="id" value="{{$experience->id}}">
         @endif
         <div class="row px-3 mx-auto mb-2">
             <div class="col-sm-10 mx-auto">
                 <div class="form-group{{ $errors->has('company') ? ' has-danger' : '' }}">
                     <input class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" name="company" id="input-company" type="text" placeholder="{{ __('Company') }}" value="@if(isset($experience->company)){{$experience->company}} @else{{old('company')}}@endif" required="true" aria-required="true" />
                     @if ($errors->has('company'))
                     <span id="company-error" class="error text-danger" for="input-company">{{ $errors->first('company') }}</span>
                     @endif
                 </div>
             </div>
         </div>
         <div class="row px-3 mx-auto mb-5">
             <div class="col-sm-10 mx-auto">
                 <div class="form-group{{ $errors->has('occupation') ? ' has-danger' : '' }}">
                     <input class="form-control{{ $errors->has('occupation') ? ' is-invalid' : '' }}" name="occupation" id="input-occupation" type="text" placeholder="{{ __('Name') }}" value="@if(isset($experience->occupation)){{$experience->occupation}} @else{{old('occupation')}}@endif" required="true" aria-required="true" />
                     @if ($errors->has('occupation'))
                     <span id="occupation-error" class="error text-danger" for="input-occupation">{{ $errors->first('occupation') }}</span>
                     @endif
                 </div>
             </div>
         </div>
         <div class="row px-3 mx-auto mb-2">
             <div class="col-sm-10 mx-auto d-flex" style="justify-content:space-around">
                 <div class="d-flex select-logo-experience">
                     <img src="@if(isset($experience->logo) && $experience->logo != null) {{$experience->logo}} @else https://via.placeholder.com/150 @endif" id="select-image" class="preview-experience-logo" alt="">
                     <input type="hidden" name="image" id="image" value="@if(isset($experience->logo) && $experience->logo != null) {{$experience->logo}} @endif">
                 </div>
                 <div class="d-flex" style="align-items:center!important">
                     <label for="from" class="label-to-date">From</label>
                     <input required type="date" name="from" id="from" class="datepicker" value="@if(isset($experience->from) && $experience->from != null){{$experience->from}}@endif">
                 </div>
                 <div class="d-flex" style="align-items:center!important">
                     <label for="to" class="label-to-date">To</label>
                     <input type="date" name="to" id="to" class="datepicker" value="@if(isset($experience->to) && $experience->to != null){{$experience->to}}@endif">
                 </div>


             </div>
         </div>
     </div>
 </div>
 <div class="card-footer">
     <div class="d-flex mt-2 mx-auto" style="width:80%;">
         <a href="{{route('user.experience', ['id' => auth()->user()->id])}}" class="button-form" style="text-align:center">
             Back
         </a>
         <button class="button-form ml-auto" type="submit">Save</button>
     </div>
 </div>

 <div class="d-none">
     <textarea name="editor" id="editor"></textarea>
 </div>