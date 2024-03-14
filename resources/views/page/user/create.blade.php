@extends('layouts.dashboard')

@section('title', 'User')

@section('content')
<form method="post" class="card">
  {{ csrf_field() }}
  <div class="card-header">
    <h4 class="card-title">@lang('web.create-user')</h4>
  </div>
  <div class="row row-cards">
    @if($errors->first('message'))
    <div class="col-12">
      <div class="card-body">
        <div class="alert alert-danger" role="alert">
          {{ $errors->first('message') }}
        </div>
      </div>
    </div>
    @endif
    <div class="col-6">
      <div class="card-body">
        <div class="form-group mb-3">
          <label class="form-label">@lang('web.username')*</label>
          <div>
            <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="@lang('web.enter-username')">
          </div>
          <small class="form-text text-danger">{{ $errors->first('username') }}</small>
        </div>
        <div class="mb-3">
          <div class="form-label">@lang('web.select-role')*</div>
          <select name="role_id" class="form-select">
            @foreach($roles as $role)
              @if ($role->name === 'superadmin')
             
              @else
                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected':'' }}>{{ ucwords($role->name) }}</option>
              @endif
            @endforeach
          </select>
          <small class="form-text text-danger">{{ $errors->first('role_id') }}</small>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card-body">
        <div class="form-group mb-3">
          <label class="form-label">@lang('web.password')*</label>
          <div>
            <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="@lang('web.enter-password')" autocomplete="new-password">
          </div>
          <small class="form-text text-danger">{{ $errors->first('password') }}</small>
        </div>
        <div class="form-group mb-3">
          <label class="form-label">@lang('web.confirm-password')*</label>
          <div>
            <input type="password" name="confirmPassword" value="{{ old('confirmPassword') }}" class="form-control" placeholder="@lang('web.enter-confirm-password')">
          </div>
          <small class="form-text text-danger">{{ $errors->first('confirmPassword') }}</small>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer text-end">
    <div class="d-flex">
      <a href="{{ route('user.index') }}" class="btn btn-link btn-loader">@lang('web.back')</a>
      <button type="submit" class="btn btn-primary ms-auto btn-loader">@lang('web.submit')</button>
    </div>
  </div>
</form>
@endsection

@section('js')
@endsection