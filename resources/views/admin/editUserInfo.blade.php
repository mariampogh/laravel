@extends('layouts.app')

@section('content')
	<div class="container">
		@if(session()->has('message'))
		    <div class="alert alert-success">
		        {{ session()->get('message') }}
		    </div>
		@endif
        <div class="card text-center ">
			<div class="card-header bg-info">
		    	<h4>Edit User Info</h4>	
		  	</div>
		  	<div class="card-body form-group">

		  		<form action="{{ route('users.update',$user->id) }}" method="post">
		  			{!! method_field('put') !!}
          		    {!! csrf_field() !!}

 	 					<div class="form-group">
    					<label >Email address</label>
    					<input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter email" value = "{{ $user->email }}" name = "email">
    					@if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
    				</div>
					<div class="form-group">
						<label >User Name</label>
					    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"  placeholder="UserName" value = "{{ $user->name }}" name="name">
					    @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group">
			          <label for="address" class="col-form-label">Address</label>
			          <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{$user->address}}" >

			            @if ($errors->has('address'))
			                <span class="inevalid-feedback" role="alert">
			                    <strong>{{ $errors->first('address') }}</strong>
			                </span>
			            @endif
			                      
			        </div>
			        <div class="form-group ">
			          <label for="phone" class="col-form-label">Phone</label>
			          <input id="phone" type="number"  class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{$user->phone}}" >

			            @if ($errors->has('phone'))
			                <span class="inevalid-feedback" role="alert">
			                    <strong>{{ $errors->first('phone') }}</strong>
			                </span>
			            @endif
			                      
			        </div>
  					<button type="submit" class="btn btn-primary">Edit</button>
				</form>
		    </div>
		</div>
	</div>
@endsection
