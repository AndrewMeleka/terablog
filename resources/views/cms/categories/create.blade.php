@extends('layouts.cms')

@section('content')
    <section id="laraCateAdd">
        <div class="text-center my-3">
            <h3>{{isset($cateData) ? 'Edit' : 'Create'}} Category</h3>
            <p>Very simple to {{isset($cateData) ? 'Edit' : 'Create New One'}}</p>
        </div>
        {{-- Errors Display --}}
       @include('partials.errors')
        @if (isset($cateData))
            <form action="{{route('categories.update',$cateData->id) }}" method="POST">
            <input name="mycateid" type="hidden" value="{{$cateData->id}}">
        @else
            <form action="{{ route('categories.store')}}" method="POST">
        @endif
            @csrf
            @if (isset($cateData))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{isset($cateData) ? $cateData->name: ''}} ">
            </div>  
            <div class="my-3 d-flex justify-content-end">
                <a href="{{route('categories.index')}}" class="btn btn-outline-dark btn-lg mr-2">Back</a>
                <input type="submit" class="btn btn-success btn-lg" value="Submit">
            </div>
        </form>
    </section>
@endsection