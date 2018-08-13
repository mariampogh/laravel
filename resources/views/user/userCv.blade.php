@extends('layouts.app')

@section('content')
<div class="container">
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
      @foreach($cv as $cvItem)
        <div class="form-group mt-3">
          <div style="font-weight: bold;">
            {{$cvItem->answear}}
          </div>
        </div>
    @endforeach

  </div>
		
</div>

@endsection
