@extends('layouts.app')

@section('content')
<div class="container  rounded p-3 mt-3 " style="border:1px solid rgb(23, 162, 184)">
    <h3 class="border-bottom" style="color:rgb(23, 162, 184);">{{$user->name}} cv</h3>
   	<form action="{{ route('admin.editCv') }}" method="post"> 
   		{!! csrf_field() !!}
      <input type="hidden" name="id" value="{{ $user->id }}">
   		@foreach($cv as $key => $cvItem)
	  		<div class="form-group mt-3">
	  			<label for="disabledTextInput" style="font-weight: bold;">
	  				{{$cvItem->question }}
	  			</label>
      			<input type="hidden" class="form-control" name ="question{{ $key }}" value = "{{ $cvItem->question }}">
      			<input type="text" class="form-control" name ="answear{{ $key }}" value = "{{ $cvItem->answear }}">
      			
    		</div>
		@endforeach
      	<button type="submit" class="btn btn-primary">Edit</button>
 
	</form>		
</div>

@endsection
