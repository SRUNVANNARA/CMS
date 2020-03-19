@extends('layouts.app')


@section('content')

@if($errors->any())
<ul class="list-group mb-2 ">
    @foreach ($errors->all() as $error)
    <li class="list-group-item list-group-item-danger">{{$error}}</li>
    @endforeach
</ul>
@endif
@if (session()->has('error'))
            <li class="list-group-item list-group-item-danger mb-2">{{session()->get('error')}}</li>
@endif

<div class="card">
    <div class="card-header">
        {{isset($tag) ? 'Edit Category':'Category'}}
    </div>
    <div class="card-body">
    <form action="{{isset($tag) ? route('tags.update',$tag->id) : route('tags.store')}}" method="POST">
        @csrf
        @isset($tag)
          @method('PUT')
        @endisset
            <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{isset($tag) ? $tag->name : ''}}">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">{{isset($tag) ? 'Update' : 'Add Tag'}}</button>
            <a href="{{route('tags.index')}}" class="btn btn-warning btn-sm">Cancel</a>
    </div>
  </div>
@endsection
