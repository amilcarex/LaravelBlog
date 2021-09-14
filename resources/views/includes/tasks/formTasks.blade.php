 <div class="card-body">
     <div>
         @csrf
         @if(isset($task))
         <input type="hidden" name="id" value="{{$task->id}}">
         @endif
         <div class="row px-3 mx-auto mb-2">
             <div class="col-sm-10 mx-auto">
                 <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                     <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="@if(isset($task->name)){{$task->name}} @else{{old('name')}}@endif" required="true" aria-required="true" />
                     @if ($errors->has('name'))
                     <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                     @endif
                 </div>
             </div>
         </div>
         <div class="row px-3 mx-auto mb-2">
             <div class="col-sm-10 mx-auto">
                 <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                     <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" placeholder="{{__('Description')}}" cols="15" rows="5" required>@if(isset($task->description)){{ $task->description }}@else{{ old('description')}}@endif</textarea>
                     @if ($errors->has('description'))
                     <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                     @endif
                 </div>
             </div>
         </div>
         @if(isset($task) && isset($statuses))
         <div class="row px-3 mx-auto mb-2">
             <label class="col-sm-2 col-form-label label-tasks">{{ __('Status') }}</label>
             <div class="col-sm-10">
                 <div class="form-group{{ $errors->has('status') ? ' has-danger' : '' }}">
                     <select name="status" id="status" class="form-control" style="cursor:pointer">
                         @foreach($statuses as $status)
                         <option value="{{$status->id}}" @if(isset($status->name) && $task->status_id == $status->id) selected @endif>{{$status->name}}</option>
                         @endforeach
                     </select>
                     @if ($errors->has('status'))
                     <span id="status-error" class="error text-danger" for="input-status">{{ $errors->first('status') }}</span>
                     @endif
                 </div>
             </div>
         </div>
         @endif

     </div>
 </div>
 <div class="card-footer">
     <div class="d-flex mt-2 mx-auto" style="width:80%;">
         <a href="{{route('index.task')}}" class="button-form" style="text-align:center">
             Back
         </a>
         <button class="button-form ml-auto" type="submit">Save</button>
     </div>
 </div>