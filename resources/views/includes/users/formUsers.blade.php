<div class="d-flex container-profile-edit col-md-12">
    <div class="col-md-8">
        <div class="card py-2">
            <div class="card-header card-header-primary d-flex">
                <div>
                    <h4 class="card-title">@if(isset($user)){{ __('Edit User') }}@else{{ __('Create User') }} @endif</h4>
                    <p class="card-category">{{ __('User information') }}</p>
                </div>
                <div class="ml-auto d-flex">
                    @if(auth()->user()->admin == 1)
                    <form action="{{route('show.user')}}" class="d-flex" method="post">
                        @csrf
                        @if(isset($user))
                        <div class="d-flex container-show container-options-profile mr-3">


                            @method('patch')

                            <input type="hidden" name="user_id" value="{{$user->id}}">

                            <input type="checkbox" @if($user->show == 1) checked @endif name="show" id="show" class=""><label class="" for="show" style="color:white!important;">Show</label>

                        </div>
                        <div>
                            <button type="submit" class="button-show" style="cursor:pointer;     margin-right: 15px;padding: 5px 10px;background: #bf69ce;border-radius: 5px;color: white;border-style: none;font-weight: 700;margin-top:8px">save</button>
                        </div>
                        @endif
                    </form>
                    @endif
                    @if(isset($user->id))
                    @if(auth()->user()->id == $user->id)
                    <div class="container-options-profile" style="align-self:center">
                        <a href="{{route('user.experience', ['id' => $user->id])}}" class="experience-button" style="color:white"><i class="material-icons">add_circle_outline</i></a>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
            <form method="post" action="@if(isset($user)){{route('update.user')}}@else{{route('store.user')}} @endif" autocomplete="off" class="form-horizontal">
                @csrf
                @if(isset($user))
                @method('patch')
                <input type="hidden" value="{{$user->id}}" name="user_id" id="user_id">
                @endif
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
                    <div class="row px-3 mx-auto">
                        <div class="col-sm-10 mx-auto">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="@if(isset($user->name)){{$user->name}} @else{{old('name')}}@endif" required="true" aria-required="true" />
                                @if ($errors->has('name'))
                                <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row px-3 mx-auto">
                        <div class="col-sm-10 mx-auto">
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="@if(isset($user->email)) {{ $user->email }} @else {{ old('email') }} @endif" required />
                                @if ($errors->has('email'))
                                <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row px-3 mx-auto">
                        <div class="col-sm-10 mx-auto">
                            <div class="form-group{{ $errors->has('hierarchy') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('hierarchy') ? ' is-invalid' : '' }}" name="hierarchy" id="input-hierarchy" placeholder="{{ __('Hierarchy') }}" value="@if(isset($user->hierarchy)) {{ $user->hierarchy }} @else{{old('hierarchy')}}@endif" required />
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
                                <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="input-description" placeholder="{{__('Description')}}" cols="15" rows="5" required>@if(isset($user->description)){{ $user->description }}@else{{ old('description')}}@endif</textarea>
                                @if ($errors->has('description'))
                                <span id="description-error" class="error text-danger" for="input-description">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row px-3 mx-auto">
                        <div class="col-sm-10 mx-auto">
                            <div class="form-group{{ $errors->has('skills') ? ' has-danger' : '' }}">
                                <textarea class="form-control{{ $errors->has('skills') ? ' is-invalid' : '' }}" name="skills" id="input-skills" placeholder="{{ __('Skills') }}" cols="15" rows="5">@if(isset($user->skills)){{ $user->skills }}@else{{ old('skills') }}@endif</textarea>
                                @if ($errors->has('skills'))
                                <span id="skills-error" class="error text-danger" for="input-skills">{{ $errors->first('skills') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if(!isset($user))
                    <div class="row px-3 mx-auto">
                        <div class="col-sm-10 mx-auto">
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('New Password') }}" value="@if(isset($user->password)){{ $user->password }}@else{{ old('password') }}@endif" required />
                                @if ($errors->has('password'))
                                <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="row px-3 mx-auto">
                        <div class="col-sm-10 mx-auto">
                            <div class="form-group">
                                <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm New Password') }}" value="" required />
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row px-3 mx-auto">
                        <div class="col-sm-10 mx-auto">
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('Current Password') }}" required />
                                @if ($errors->has('password'))
                                <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row px-3 mx-auto">
                        <div class="col-sm-10 mx-auto">
                            <div class="form-group{{ $errors->has('new_password') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password" id="input-new_password" type="password" placeholder="{{ __('New Password') }}" required />
                            </div>
                            @if ($errors->has('new_password'))
                            <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('new_password') }}</span>
                            @endif
                        </div>
                    </div>
                    @endif


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary ml-auto">@if(isset($user)){{__('Edit User')}}@else{{ __('Create User') }}@endif</button>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-md-4">
        @if(isset($user))
        <div class="">
            <div class="card py-2">
                <div class="card-header container-image-card">
                    <img src="@if($user->image != null) {{$user->image}} @else https://via.placeholder.com/150  @endif" alt="test" class="image-profile-card">
                </div>
                <div class="card-body">
                    @if($user->name != null)
                    <p class="hierarchy-card text-card">
                        {{$user->hierarchy}}
                    </p>
                    @endif
                    <p class="name-card text-card">
                        {{$user->name}}
                    </p>
                    <p class="description-card text-card">
                        {{$user->description}}
                    </p>
                </div>
            </div>
        </div>
        @endif
        <div class="">
            <div class="container-select-profile-image">
                <div class="card py-2">
                    <div class="card-header container-image-card">
                        <img src="https://via.placeholder.com/150" id="image-profile-card" alt="test" class="image-profile-card">
                    </div>

                    <div class="py-4">
                        <input id="image" name="image" type="hidden" class="d-none" value="@if(isset($user->image)) {{ $user->image }} @else {{ old('image') }} @endif">
                        <div class="d-flex mt-2">
                            <button class="button-select-image mx-auto" id="button-select-image">Select Image</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</form>
<div class="d-none">
    <textarea id="editor" class="d-none"></textarea>
</div>