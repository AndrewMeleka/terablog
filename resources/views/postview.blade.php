@extends('layouts.app')

@section('header')
    <header id="teraHeader">
    <img src="{{asset('storage/'.$PostData->image)}}" class="tera-banner" width="100" alt="post image">
        <!-- Content  -->
        <div class="text-light" style="z-index: 999;">
        <h2 class="tera-text-8">{{$PostData->title}}</h2>
        <a class="text-capitalize tera-text-2 btn btn-light btn-sm" href="/">back</a>
        </div>
    </header>
@endsection

@section('teracontent')
    <div class="tera-document">     
        {!! $PostData->content !!}
    </div>
@endsection



@section('scripts')
<script>
    const myHeader = document.getElementById('teraHeader');
    myHeader.style.height = `${window.innerHeight / 1.4}px`;   // set header to full screen
</script>
@endsection