@extends('layouts.app')

@section('content')
<div class="container" >
  @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
  @endif
  <div class="card d-inline-block ml-2" >
    <div class="card-body">
      <h5 class="card-title">{{$info->name}}</h5>
      <form action="{{route('editInfo')}}" method="post">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="name" class="col-form-label">{{ __('Name') }}</label>
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$info->name}}"  autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif            
        </div>
        <div class="form-group row">
          <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>
          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$info->email}}" >

            @if ($errors->has('email'))
                <span class="inevalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
                      
        </div>
        <div class="form-group row">
          <label for="address" class="col-form-label">Address</label>
          <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{$info->address}}" >

            @if ($errors->has('address'))
                <span class="inevalid-feedback" role="alert">
                    <strong>{{ $errors->first('address') }}</strong>
                </span>
            @endif
                      
        </div>
        <div class="form-group row">
          <label for="phone" class="col-form-label">Phone</label>
          <input id="phone" type="number"  class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{$info->phone}}" >

            @if ($errors->has('phone'))
                <span class="inevalid-feedback" role="alert">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
                      
        </div>

        <button type="submit" class="btn btn-primary">SaveChanges</button>
      </form>
    </div>
  </div>
  <div class="card d-inline-block  ml-2">
    <div class="card-body">
      <h5 class="card-title">Change Password</h5>
      <form action="{{ route('user.changePwd') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="password" class="col-form-label ">{{ __('Password') }}</label>            
              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

              @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
                            
        </div>

        <div class="form-group row">
          <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}</label>
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">ChangePassword</button>
      </form>
    </div>
  </div>
</div>
 

@endsection
