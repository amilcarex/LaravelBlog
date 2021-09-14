<div class="card py-2">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('Edit Profile') }}</h4>
        <p class="card-category">{{ __('User information') }}</p>
    </div>
    <div class="card-body ">
        @if (session('status'))
        <div class="row ">
            <div class="col-sm-12">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span>{{ session('status') }}</span>
                </div>
            </div>
        </div>
        @endif

        <div class="d-flex container-buttons-experience" style="width:90%!important; margin:0 auto;">
            @if(auth()->user()->admin == 1)
            <div class="d-flex container-show container-options-profile">
                <input type="checkbox" @if(auth()->user()->show == 1) checked @endif name="show" id="show" class=""><label class="" for="show">Show</label>
            </div>
            @endif
            <div class="container-options-profile">
                <a href="{{route('user.experience', ['id' => auth()->user()->id])}}" class="experience-button"><i class="material-icons">add_circle_outline</i></a>
            </div>

        </div>
        <div class="row px-3 mx-auto">
            <div class="col-sm-10 mx-auto">
                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required="true" aria-required="true" />
                    @if ($errors->has('name'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row px-3 mx-auto">
            <div class="col-sm-10 mx-auto">
                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required />
                    @if ($errors->has('email'))
                    <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row px-3 mx-auto">
            <div class="col-sm-10 mx-auto">
                <div class="form-group{{ $errors->has('hierarchy') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('hierarchy') ? ' is-invalid' : '' }}" name="hierarchy" id="input-hierarchy" placeholder="{{ __('Hierarchy') }}" value="{{ old('hierarchy', auth()->user()->hierarchy) }}" />
                    @if ($errors->has('hierarchy'))
                    <span id="hierarchy-error" class="error text-danger" for="input-hierarchy">{{ $errors->first('hierarchy') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row px-3 mx-auto">
            <div class="col-sm-10 mx-auto">
                <div class="form-group{{ $errors->has('admin') ? ' has-danger' : '' }}">
                    <select name="role" id="role" class="form-control" style="cursor:pointer">
                        <option value="">Select Role</option>
                        @foreach($roles as $role)
                        <option value="{{$role->id}}" @if(isset($user->role->name) && $user->role->name == $role->name) selected @endif>{{$role->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('admin'))
                    <span id="admin-error" class="error text-danger" for="input-admin">{{ $errors->first('admin') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row px-3 mx-auto">
            <div class="col-sm-10 mx-auto">
                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                    <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" placeholder="{{__('Description')}}" cols="15" rows="5" >{{ old('description', auth()->user()->description) }}</textarea>
                    @if ($errors->has('description'))
                    <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row px-3 mx-auto">
            <div class="col-sm-10 mx-auto">
                <div class="form-group{{ $errors->has('skills') ? ' has-danger' : '' }}">
                    <textarea class="form-control{{ $errors->has('skills') ? ' is-invalid' : '' }}" name="skills" id="input-skills" placeholder="{{ __('Skills') }}" cols="15" rows="5">{{ old('skills', auth()->user()->skills) }}</textarea>
                    @if ($errors->has('skills'))
                    <span id="skills-error" class="error text-danger" for="input-skills">{{ $errors->first('skills') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary ml-auto">{{ __('Update User') }}</button>
    </div>
</div>