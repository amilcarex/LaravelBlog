<div class="card py-2">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('Change password') }}</h4>
        <p class="card-category">{{ __('Password') }}</p>
    </div>
    <div class="card-body ">
        @if (session('status_password'))
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="material-icons">close</i>
                    </button>
                    <span>{{ session('status_password') }}</span>
                </div>
            </div>
        </div>
        @endif
        <div class="row px-3 mx-auto">
            <div class="col-sm-10 mx-auto">
                <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" input type="password" name="old_password" id="input-current-password" placeholder="{{ __('Current Password') }}" value="" required />
                    @if ($errors->has('old_password'))
                    <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('old_password') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row px-3 mx-auto">
            <div class="col-sm-10 mx-auto">
                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('New Password') }}" value="" required />
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
    </div>
    <div class="card-footer ">
        <button type="submit" class="btn btn-primary ml-auto">{{ __('Change password') }}</button>
    </div>
</div>