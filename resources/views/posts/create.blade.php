@extends('layouts.app')


@section('content')

@if($errors->any())
<ul class="list-group mb-2 ">
    @foreach ($errors->all() as $error)
    <li class="list-group-item list-group-item-danger">{{$error}}</li>
    @endforeach
</ul>
@endif

<div class="card">
    <div class="card-header">
       Category
    </div>
    <div class="card-body">
        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
            </div>
            <div class="form-group">
                <label for="description">Desrription</label>
                <textarea name="description" id="description" name="description" cols="2" rows="2" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" name="content" cols="5" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Images</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="publish_at">Publish At</label>
                <input type="text" class="form-control" id=publish_at" name="publish_at" aria-describedby="publish_at">
              </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
  </div>
@endsection
