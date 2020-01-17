@extends('layouts.cms')

@section('content')
    <section id="laraCateAdd">
        <div class="text-center my-3">
            <h3>{{isset($postData) ? 'Edit' : 'Create'}} Post</h3>
            <p>Very simple to {{isset($postData) ? 'Edit' : 'Create New One'}}</p>
        </div>
        
        {{-- Errors Display --}}
        @include('partials.errors')

        @if (isset($postData))
            <form action="{{route('posts.update',$postData->id) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="myid" value="{{$postData->id}}">
                @method('PUT')
        @else
            <form action="{{ route('posts.store')}}" method="POST" enctype="multipart/form-data">
        @endif
                @csrf
                <div class="form-group my-5">
                    <label for="name">Title</label>
                    <input type="text" name="title" class="form-control" value="{{isset($postData) ? $postData->title: ''}} ">
                </div>  
                <div class="form-group my-5">
                    <label for="body">Body</label>
                    <textarea cols="5" rows="5" class="form-control" name="body">{{isset($postData) ? $postData->body: ''}}</textarea>
                </div>  
                <div class="form-group my-5">
                    <label for="content">Content</label> <br>
                    <input id="dataContent" type="hidden" value="{{isset($postData) ? $postData->content: ''}}" name="content">
                    <trix-editor input="dataContent" class="trixHeight"></trix-editor>
                </div>  
                <div class="form-group my-5">
                    <label for="published">Published At</label> <br>
                    <input name="published" id="flatPublished" class="flatpickr form-control input" type="text" value="{{isset($postData) ? $postData->published_at: ''}}" data-input>
                </div>  
                <div class="form-group my-5">
                    <label for="category">Select Category</label> <br>
                    <select name="category" class="form-control input">
                        @foreach ($categories as $cate)
                            @if (isset($postData))
                                <option {{$cate->id === $postData->category_id ? 'selected' : ''}}
                                value="{{$cate->id}}">{{$cate->name}}</option>
                            @else
                                <option value="{{$cate->id}}">{{$cate->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>  
                <div class="form-group my-5">
                    @if (isset($postData))
                        <h3 class="text-capitalize">current image</h3>
                        <img src="{{asset('storage/'.$postData->image)}}" width="100%" class="my-2" alt="view post image">
                    @endif
                    <label for="image">Image Upload</label> 
                    <input name="image" class="form-control" type="file" >
                </div>  
                <div class="my-5 d-flex justify-content-end">
                    <a href="{{route('posts.index')}}" class="btn btn-outline-dark btn-lg mr-2">Back</a>
                    <input type="submit" class="btn btn-success btn-lg" value="Submit">
                </div>
            </form>
    </section>
@endsection


@section('headLinks')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.3/flatpickr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script>
        flatpickr('#flatPublished',{});
        document.querySelector("trix-editor").editor;  // is a Trix.Editor instance
    </script>
@endsection