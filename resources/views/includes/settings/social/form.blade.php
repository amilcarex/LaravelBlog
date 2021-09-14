<div class="col-md-11 mx-auto">
    <div class="row px-3 mx-auto col-md-12 mb-3">
        <div class="form-group{{ $errors->has('webTittle') ? ' has-danger' : '' }}" style="width:100%!important">
            <label for="facebook" style="margin-right:10px;align-self: center;" class="mb-2">Facebook:</label>
            <input class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}" name="facebook" id="input-facebook" type="text" value="@if(isset($settings->facebook)){{$settings->facebook}} @else{{old('facebook')}}@endif" />
            @if ($errors->has('facebook'))
            <span id="facebook-error" class="error text-danger" for="input-facebook">{{ $errors->first('facebook') }}</span>
            @endif
        </div>
    </div>
    <div class="row px-3 mx-auto col-md-12 mb-3">
        <div class="form-group{{ $errors->has('twitter') ? ' has-danger' : '' }}" style="width:100%!important">
            <label for="twitter" style="margin-right:10px;align-self: center;" class="mb-2">Twitter:</label>
            <input class="form-control{{ $errors->has('twitter') ? ' is-invalid' : '' }}" name="twitter" id="input-twitter" type="text" value="@if(isset($settings->twitter)){{$settings->twitter}} @else{{old('twitter')}}@endif" />
            @if ($errors->has('twitter'))
            <span id="twitter-error" class="error text-danger" for="input-twitter">{{ $errors->first('twitter') }}</span>
            @endif
        </div>
    </div>
    <div class="row px-3 mx-auto col-md-12 mb-3">
        <div class="form-group{{ $errors->has('instagram') ? ' has-danger' : '' }}" style="width:100%!important">
            <label for="instagram" style="margin-right:10px;align-self: center;" class="mb-2">Instagram:</label>
            <input class="form-control{{ $errors->has('instagram') ? ' is-invalid' : '' }}" name="instagram" id="input-instagram" type="text" value="@if(isset($settings->instagram)){{$settings->instagram}} @else{{old('instagram')}}@endif" />
            @if ($errors->has('instagram'))
            <span id="instagram-error" class="error text-danger" for="input-webTittle">{{ $errors->first('instagram') }}</span>
            @endif
        </div>
    </div>
    <div class="row px-3 mx-auto col-md-12 mb-3">
        <div class="form-group{{ $errors->has('linkedIn') ? ' has-danger' : '' }}" style="width:100%!important">
            <label for="linkedIn" style="margin-right:10px;align-self: center;" class="mb-2">Linked In:</label>
            <input class="form-control{{ $errors->has('linkedIn') ? ' is-invalid' : '' }}" name="linkedIn" id="input-linkedIn" type="text" placeholder="" value="@if(isset($settings->linkedIn)){{$settings->linkedIn}} @else{{old('linkedIn')}}@endif"  />
            @if ($errors->has('linkedIn'))
            <span id="linkedIn-error" class="error text-danger" for="input-linkedIn">{{ $errors->first('linkedIn') }}</span>
            @endif
        </div>
    </div>
    <div class="row px-3 mx-auto col-md-12 mb-3">
        <div class="form-group{{ $errors->has('youtube') ? ' has-danger' : '' }}" style="width:100%!important">
            <label for="youtube" style="margin-right:10px;align-self: center;" class="mb-2">Youtube:</label>
            <input class="form-control{{ $errors->has('youtube') ? ' is-invalid' : '' }}" name="youtube" id="input-youtube" type="text" placeholder="" value="@if(isset($settings->youtube)){{$settings->youtube}} @else{{old('youtube')}}@endif" />
            @if ($errors->has('youtube'))
            <span id="youtube-error" class="error text-danger" for="input-youtube">{{ $errors->first('youtube') }}</span>
            @endif
        </div>
    </div>
    <div class="row px-3 mx-auto col-md-12 mb-3">
        <div class="form-group{{ $errors->has('github') ? ' has-danger' : '' }}" style="width:100%!important">
            <label for="github" style="margin-right:10px;align-self: center;" class="mb-2">Github :</label>
            <input class="form-control{{ $errors->has('github') ? ' is-invalid' : '' }}" name="github" id="input-github" type="text" placeholder="" value="@if(isset($settings->github)){{$settings->github}} @else{{old('github')}}@endif"/>
            @if ($errors->has('github'))
            <span id="github-error" class="error text-danger" for="input-github">{{ $errors->first('github') }}</span>
            @endif
        </div>
    </div>
    <div class="row px-3 mx-auto col-md-12 mb-3">
        <div class="form-group{{ $errors->has('twitch') ? ' has-danger' : '' }}" style="width:100%!important">
            <label for="allowRegister" style="margin-right:10px;align-self: center;" class="mb-2">Twitch :</label>
            <input class="form-control{{ $errors->has('twitch') ? ' is-invalid' : '' }}" name="twitch" id="input-twitch" type="text" value="@if(isset($settings->twitch)){{$settings->twitch}} @else{{old('twitch')}}@endif"  />
            @if ($errors->has('twitch'))
            <span id="twitch-error" class="error text-danger" for="input-twitch">{{ $errors->first('twitch') }}</span>
            @endif
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary ml-auto">{{__('Save')}}</button>
    </div>
</div>
<div class="d-none">
    <textarea id="editor" class="d-none"></textarea>
</div>