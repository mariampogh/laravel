@extends('layouts.app')

@section('content')
<div class="container">
    
    <div id = "app">
       <div class="dropdown">
			<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
		    	Choose your profession
			</button>
			<div class="dropdown-menu">
				<ul class="list-group">
					@foreach($professions as $profession)
	  					<li class="list-group-item list-group-item-primary">
			  				<a class="dropdown-item" href="{{ route('blankCv', $profession->id) }}">
					    		{{ $profession->profession }}
					    	</a>
	  					</li>
			    	@endforeach
			    </ul>
			</div>
			
		  
		</div>
    </div>

</div>

@endsection

