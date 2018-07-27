@extends('layouts.app')

@section('content')
	<div class="container-fluid" style="overflow: hidden;">
	    @include('admin.leftMenu')
	    @include('admin.delete')

	    <div class="col-10 float-left">
	    	<div style = "margin-left:3%">
				<h3 class="border-bottom">Users <span class="badge badge-info">{{$countUsers}}</span></h3>
				<a href="{{ route('users.create') }}">
					<i class="fa fa-plus btn" aria-hidden="true" style="font-size: 200%;"  ></i>
				</a> 

			</div>

			<table class="table table-striped mt-3" style = "margin-left:3%">
				<thead>
			    	<tr>
			    		<th scope="col">#</th>
			      		<th scope="col">UserName</th>
			      		<th scope="col">Email</th>
			      		<th scope="col">Password</th>
			      		<th scope="col">Edit</th>
			      		<th scope="col">Delete</th>
			    	</tr>
			  	</thead>
			  	<tbody>
			  		@foreach($users as $key=>$user)
				    	<tr>
				      		<td scope="row">{{++$key}}</td>
				      		<td>
				      			<a href="/admin/users/{{$user->id}}">{{$user->name}}</a>
				      		</td>
							<td>{{$user->email}}</td>
							<td>***</td>
							<td>
								<form action="{{ route('users.edit', $user->id) }}" method="get">
          		    				{!! csrf_field() !!}
	              					<button type = "submit" class="btn btn-primary">
									<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</button>
								</form> 
							</td>
				      		<td>
				      			<button type="button" class="btn btn-danger delete"  data-toggle="modal" data-target="#delete" data-id= "{{$user->id}}">
				      				<i class="fa fa-trash-o" aria-hidden="true"></i>
				      			</button>
				      		</td>
				    	</tr>
			    	@endforeach
			  	</tbody>
			</table>
	    </div>
	</div>
@endsection
