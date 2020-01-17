@extends('layouts.cms')

@section('content')
    <section id="laraPost">
        <div class="text-center my-3">
            <h3>Trashed Posts</h3>
            <p class="text-capitalize">posts in trash</p>
        </div>
        <div class="my-3 d-flex justify-content-end">
        </div>
        @if($postsData->count() > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th class="d-flex justify-content-end">Options</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($postsData as $post)
                        <tr>
                            <td>
                                <img src="{{asset('storage/'.$post->image)}}" class="rounded-circle" width="50" height="50" alt="Post Image">
                            </td>
                            <td>{{$post->title}}</td>
                            <td class="d-flex justify-content-end">
                                <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-outline-danger mx-2">
                                </form>
                                <form action="{{route('restorePost',$post->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="submit" value="Restore" class="btn btn-outline-primary mx-2">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <hr>
            <h2 class="text-center text-danger text-capitalize">Ops, no trash posts yet.</h2>
        @endif
       
    </section>
@endsection