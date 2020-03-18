@extends('layouts.app')


@section('content')


    <div class="d-flex justify-content-end mb-2 mt-2">
    <a href="{{route('posts.create')}}"><div class="btn btn-primary">Add Post</div></a>
    </div>
    <div class="card card-default">
      <div class="card-header">
        Posts
      </div>
      <div class="card-body">
       
          <table class="table table-responsive">
            <thead>
              <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
                  <tr>
                    <td>
                      <img class="rounded-circle" width="100" height="100" src="{{asset('storage/').'/'.$post->image}}" alt="">
                    </td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->description}}</td>
                    <td><buttton class="btn btn-warning btn-sm">Edit</buttton></td>
                    <td>
                      <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="SUBMIT" class="btn btn-danger btn-sm">Trash</button>
                      </form>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        
      </div>
    </div>
@endsection