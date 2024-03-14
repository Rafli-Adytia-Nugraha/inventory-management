@extends('layouts.dashboard')

@section('title', 'User')

@section('content')
@if($errors->first('message'))
<div class="col-12">
  <div class="alert alert-danger" role="alert">
    {{ $errors->first('message') }}
  </div>
</div>
@endif
@if(Session::has('message'))
<div class="col-12">
  <div class="alert alert-info" role="alert">
    {{ Session::get('message') }}
  </div>
</div>
@endif
<div class="row row-cards">
  <div class="col-12">
    <div class="card">
      <div class="card-body border-bottom py-3">
        <div class="d-flex">
          @can('user-create')
            <div class="text-muted">
              <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm btn-loader">@lang('web.create-user')</a>
            </div>
          @endcan
          <div class="ms-auto text-muted">
            <form>
              <div class="ms-2 d-inline-block">
                <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control form-control-sm" aria-label="Search">
              </div>
              <button type="submit" class="btn btn-primary btn-sm btn-loader">Search</button>
            </form>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
          <thead>
            <tr>
              <th class="w-1">No</th>
              <th>Username</th>
              <th class="text-center">Role</th>
              @canany(['user-update','user-delete'])
              <th></th>
              @endcanany
            </tr>
          </thead>
          <tbody>
            @foreach($datas as $key=>$data)
              <tr>
                @php
                  $no = $key+1;
                  if(Request::has('page'))
                  {
                    $no += (Request::get('page') - 1) * 15;
                  }
                @endphp
                <td><span class="text-muted">{{ $no }}</span></td>
                <td>{{ $data->username }}</td>
                <td class="text-center">
                  @foreach($data->roles as $role)
                    @php
                      switch($role->name)
                      {
                        case 'superadmin': 
                          $check = 'primary';
                          break;
                        default: 
                          $check = 'info';
                      }
                    @endphp
                    <span class="badge btn-{{ $check }}">{{ $role->name }}</span>
                  @endforeach
                </td>
                @canany(['user-update', 'user-delete'])
                <td class="text-end">
                  @can('user-update')
                    <a href="{{ route('user.edit', $data->id) }}" class="btn btn-info btn-sm btn-loader">@lang('web.edit')</a>
                  @endcan
                  @can('user-delete')
                    <a href="#" data-href="{{ route('user.delete', $data->id) }}" class="btn btn-danger btn-sm btn-delete">@lang('web.delete')</a>
                  @endcan
                </td>
                @endcanany
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer d-flex align-items-center">
        <div class="pagination m-0 ms-auto">
          {{ $datas->links('vendor.pagination.custom') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
@endsection