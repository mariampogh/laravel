@extends('layouts.app')

@section('content')
<div class="container  rounded p-3 mt-3 " style="border:1px solid rgb(23, 162, 184)">
    <h3 class="border-bottom" style="color:rgb(23, 162, 184);">Create your cv</h3>
   	<form action="{{ route('createCv') }}" method="post"> 
   		{!! csrf_field() !!}
   		@foreach($questions as $key => $question)
	  		<div class="form-group mt-3">
	  			<label for="disabledTextInput" style="font-weight: bold;">
	  				{{$question->question }}
	  			</label>
      			<input type="hidden" class="form-control" name ="question{{ $key }}" value = "{{ $question->question }}">
      			<input type="text" class="form-control" name ="answear{{ $key }}">
      			
    		</div>
		@endforeach
      	<button type="submit" class="btn btn-primary">Create</button>
 
	</form>		
</div>

@endsection
