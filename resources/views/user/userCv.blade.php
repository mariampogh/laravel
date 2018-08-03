@extends('layouts.app')

@section('content')
<div class="container  rounded p-3 mt-3 " style="border:1px solid rgb(23, 162, 184)">
    <h3 class="border-bottom" style="color:rgb(23, 162, 184);"> {{ Auth::user()->name }} cv</h3>
   		{!! csrf_field() !!}
   		@foreach($cv as $key => $cvItem)
	  		<div class="form-group mt-3">
	  			<div for="disabledTextInput" style="font-weight: bold;">
	  				{{++$key}}.{{ $cvItem->question }}
	  			</div>
          <div for="disabledTextInput" style="font-weight: bold;">
            {{$cvItem->answear}}
          </div>
    		</div>
		@endforeach
		
</div>

@endsection
