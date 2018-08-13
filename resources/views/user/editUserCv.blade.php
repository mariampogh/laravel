@extends('layouts.app')

@section('content')
<div class="container">
  @if(session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
  @endif
  <div class="rounded p-3 mt-3 " style="border:1px solid rgb(23, 162, 184)">
      <div class="mb-3" style="color:rgb(23, 162, 184);">
        <h3 class="d-inline"> {{ Auth::user()->name }}</h3>
        <div class="d-inline float-right">
          <div class="d-inline float-left">
            <span class="d-block">{{ Auth::user()->address }}</span>
            <span class="d-block">{{ Auth::user()->phone }}</span>  
          </div>
          <a class="d-inline float-left ml-2" href="{{ route('user.exportPdf') }}">
            <i class="fa fa-download" style="font-size:150%" aria-hidden="true"></i>
          </a>
        </div>
      </div>
      <hr>
     	<form action="{{ route('user.editCv') }}" method="post"> 
     		{!! csrf_field() !!}
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
</div>

@endsection
