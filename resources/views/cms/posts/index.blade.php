@extends('layouts.cms')

@section('content')
    <section id="laraPost">
        <div class="text-center my-3">
            <h3>Posts</h3>
            <p class="text-capitalize">posts available</p>
        </div>
        <div class="my-3 d-flex justify-content-end">
        <a href="{{route('posts.create')}}" class="btn btn-success">Add New</a>
        </div>
        @if($postsData->count() > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th class="d-flex justify-content-end">Options</th>
                </tr>
                </thead>
                <tbody>
                    @if (isset($postsData))
                        @foreach ($postsData as $post)
                        <tr>
                            <td>
                                <img src="{{asset('storage/'.$post->image)}}" width="120" height="80" alt="Post Image">
                            </td>
                            <td>{{$post->title}}</td>
                            <td>
                                @if (isset($categories->find($post->category_id)->name))
                                    <a href="{{route('categories.edit',$post->category_id)}}">
                                        {{$categories->find($post->category_id)->name}}
                                    </a>
                                @else
                                   <span class="text-danger font-weight-bold">Doesn't Have</span> 
                                @endif

                            </td>
                            <td class="d-flex justify-content-end">
                                <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input name="trashonly" type="hidden">
                                    <input type="submit" value="Trash" class="btn btn-outline-danger mx-2">
                                </form>
                                <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        @else
            <hr>
            <h2 class="text-center text-danger text-capitalize">Ops, no posts yet.</h2>
        @endif
    </section>
@endsection