@extends('layouts.app')

@section('content')
	<div class="container-fluid">
        <div class="card text-center ">
			<div class="card-header bg-info">
		    	<h4>Edit User Info</h4>	
		  	</div>
		  	<div class="card-body form-group">

		  		<form action="{{ route('users.update',$user->id) }}" method="post">
		  			{!! method_field('put') !!}
          		    {!! csrf_field() !!}

          		   <!--  <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div> -->
  					<div class="form-group">
    					<label >Email address</label>
    					<input type="email" class="form-control" placeholder="Enter email" value = "{{ $user->email }}" name = "email">
    				</div>
					<div class="form-group">
						<label >User Name</label>
					    <input type="text" class="form-control"  placeholder="UserName" value = "{{ $user->name }}" name="name">
					</div>
  					<button type="submit" class="btn btn-primary">Edit</button>
				</form>
		    </div>
		</div>
	</div>
@endsection
