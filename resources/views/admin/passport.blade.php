@extends('layouts.app')

@section('content')
<div class="container-fluid" style="overflow: hidden;">
    @include('admin.leftMenu')
    <div class="row justify-content-center col-10 float-left">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Passport</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div id = "app">
                        <passport-clients></passport-clients>
                        <passport-authorized-clients></passport-authorized-clients>
                        <passport-personal-access-tokens></passport-personal-access-tokens>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

       