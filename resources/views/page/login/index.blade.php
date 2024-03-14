@extends('layouts.login')

@section('content')
<div class="text-center mb-4">
  <img src="{{ asset('logo.png') }}" height="96" alt="{{ config('app.name') }}">
</div>
<form class="card card-md" method="post" autocomplete="off">
  {{ csrf_field() }}
  <div class="card-body">
    <h2 class="card-title text-center mb-4">{{ config('app.name') }}</h2>
    @if($errors->first('login'))
      <div class="alert alert-danger" role="alert">
        {{ $errors->first('login') }}
      </div>
    @endif
    <div class="mb-3">
      <label class="form-label">Username</label>
      <input name="username" type="text" class="form-control" placeholder="Enter username">
      @if($errors->first('login'))
        <small class="text-danger">{{ $errors->first('username') }}</small>
      @endif
    </div>
    <div class="mb-2">
      <label class="form-label">
        Password
      </label>
      <div class="input-group input-group-flat">
        <input name="password" type="password" class="form-control"  placeholder="Enter password"  autocomplete="off">
      </div>
      @if($errors->first('login'))
        <small class="text-danger">{{ $errors->first('password') }}</small>
      @endif
    </div>
    <div class="mb-2">
      <label class="form-check">
        <input name="remember" type="checkbox" class="form-check-input"/>
        <span class="form-check-label">Remember me</span>
      </label>
    </div>
    <div class="form-footer">
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </div>
  </div>
</form>
@endsection