<div class="col-md-11 mx-auto">
    <div class="row px-3 mx-auto col-md-12">
        <div class="form-group{{ $errors->has('webTittle') ? ' has-danger' : '' }}" style="width:100%!important">
            <input class="form-control{{ $errors->has('webTittle') ? ' is-invalid' : '' }}" name="webTittle" id="input-webTittle" type="text" placeholder="{{ __('Web Tittle') }}" value="@if(isset($settings->webTittle)){{$settings->webTittle}} @else{{old('webTittle')}}@endif" required="true" aria-required="true" />
            @if ($errors->has('webTittle'))
            <span id="webTittle-error" class="error text-danger" for="input-webTittle">{{ $errors->first('webTittle') }}</span>
            @endif
        </div>
    </div>
    <div class="row px-3 mx-auto mb-3">
        <div class="d-flex col-md-12 px-0">
            <div class="form-group{{ $errors->has('homeVideo') ? ' has-danger' : '' }} d-flex" style="width:100%!important; margin-right:10px!important">
                <input class="form-control{{ $errors->has('homeVideo') ? ' is-invalid' : '' }}" name="homeVideo" id="input-homeVideo" type="text" placeholder="{{ __('Home Video') }}" value="@if(isset($settings->homeVideo)){{$settings->homeVideo}} @else{{old('homeVideo')}}@endif" style="margin-right:15px!important" />
                @if ($errors->has('homeVideo'))
                <span id="homeVideo-error" class="error text-danger" for="input-homeVideo">{{ $errors->first('homeVideo') }}</span>
                @endif
                <button class="select-settings" id="select-video"><i class="material-icons icon-select-settings">file_upload</i></button>
            </div>

            <div class="d-flex" style="margin-top:5px!important">
                <label for="local" style="align-self:center!important; margin-right:5px">Local</label>
                <input type="checkbox" name="local" id="local" style="margin-top:-10px">
            </div>
        </div>
    </div>
    <div class="row px-3 mx-auto mb-3">
        <div class="d-flex col-md-12 px-0">
            <label for="allowRegister" style="margin-right:10px">Members:</label>
            <input type="checkbox" name="allowRegister" id="allowRegister" style="margin-top:5px; align-self:baseline; margin-right:10px">
            <label for="">Allow User Registration (This Instruction will enable the registration of users to the public)</label>
        </div>
    </div>
    <div class="row px-3 mx-auto mb-4">
        <div class="d-flex col-md-12 px-0">
            <label for="allowRegister" style="margin-right:10px;align-self: center;">Pinned Order:</label>
            <select name="pinnedOrder" id="pinnedOrder" class="form-control select-order" style="padding-top:0; margin-right:5px">
                @php($pinnedOrder = ['Desc', 'Asc'])
                @foreach($pinnedOrder as $order)
                <option @if($settings->pinnedOrder == $order) selected @endif value="{{$order}}">{{$order}}</option>
                @endforeach
            </select>
            <label for="" style="align-self: center;">Desc equals most recent first | Asc equals most older first</label>
        </div>
    </div>
    <div class="row px-3 mx-auto">
        <div class="d-flex col-md-12 px-0">
            <label for="defaultRole" style="margin-right:10px;align-self: center;">Default Role:</label>
            <select name="defaultRole" id="defaultRole" class="form-control select-order" style="padding-top:0; margin-right:5px">
                @foreach($roles as $role)
                <option @if($settings->defaultRole == $role['id']) selected @endif value="{{$role['id']}}">{{$role['type']}}</option>
                @endforeach

            </select>
            <label for="" style="align-self: center;">(Default role for registered users)</label>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary ml-auto">{{__('Save')}}</button>
    </div>
</div>
<div class="d-none">
    <textarea id="editor" class="d-none"></textarea>
</div>