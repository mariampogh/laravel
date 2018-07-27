@extends('layouts.app')

@section('content')
	<div class="container-fluid" style="overflow: hidden;">
    @include('admin.leftMenu')
    <posts-index class="col-10 float-left" :posts="{{$posts}}"></posts-index>
	</div>
@endsection

