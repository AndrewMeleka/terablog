@extends('layouts.cms')

@section('content')
    <div class="container">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <p class="mb-0 text-capitalize tera-text-2">
            Welcome admin let's control your blog, or <br>
            <a href="/">checkout website</a>
        </p>
    </div>
@endsection
