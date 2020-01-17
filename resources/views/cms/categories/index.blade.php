@extends('layouts.cms')

@section('content')
    <section id="laraCate">
        <div class="text-center my-3">
            <h3>Categories</h3>
            <p>Categories that what post should be show</p>
        </div>
        <div class="my-3 d-flex justify-content-end">
        <a href="{{route('categories.create')}}" class="btn btn-success">Add New</a>
        </div>
        @if ($cateData->count())
        <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Posts Count</th>
                <th class="text-right">Options</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($cateData as $cate)
                    <tr>
                        <td>{{$cate->name}}</td>
                        <td>{{$cate->find($cate->id)->posts->count()}}</td>
                        <td class="text-right">
                            <button class="btn btn-outline-danger mx-2" onclick="openDeleteModal({{$cate->id}})">Delete</button>
                            <a href="{{route('categories.edit',$cate->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
          {{-- Modal  --}}
        <div class="modal fade" id="destroyModal" tabindex="-1" role="dialog" aria-labelledby="destroyModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="destroyModalLabel">Delete </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    Are you sure you want delete this item from category list
                </div>
                <div class="modal-footer">
                    <form id="formToDelete" action="{{route('categories.destroy',$cate->id)}}" method="POST">
                        @csrf
                        @method('DELETE') 
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>          
                </div>
            </div>
            </div>
        </div>
        @else   
            <hr>
            <h2 class="text-center text-danger text-capitalize">Ops, no categories yet.</h2>
        @endif

    </section>
@endsection

@section('scripts')
    <script>
        function openDeleteModal(id) {
            let myForm = document.getElementById('formToDelete');
            myForm.action = "categories/"+id;
            $('#destroyModal').modal('show');
        }
    </script>
@endsection