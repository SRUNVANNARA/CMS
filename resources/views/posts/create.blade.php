@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
    


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
       {{isset($post) ? 'Edit' : 'Add'}}
    </div>
    <div class="card-body">
        <form action="{{isset($post) ? route('posts.update',$post->id) : route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($post))
                @method('PUT')
            @endif
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" value="{{isset($post) ? $post->title : ''}}">
            </div>
            <div class="form-group">
                <label for="description">Desrription</label>
                <textarea name="description" id="description" cols="2" rows="2" class="form-control">{{isset($post) ? $post->description : ''}}</textarea>
            </div>
            <div class="form-group">
                <input id="content" type="hidden" name="content" value="{{isset($post) ? $post->content : ''}}">
                <trix-editor input="content"  ></trix-editor>
            </div>
           
                @if(isset($post))
                    <div class="form-group">
                        <img class="rounded-circle" width="100" height="100" src="{{asset('storage/').'/'.$post->image}}" alt="">
                    </div>
                @endif
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                @if(isset($post))
                                    @if($category->id==$post->category_id)
                                            selected
                                            @endif
                                    @endif
                            >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
          
            <div class="form-group">
                <label for="image">Images</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="publish_at">Publish At</label>
                <input type="text" class="form-control" id="publish_at" name="publish_at" value="{{isset($post) ? $post->publish_at : ''}}">
              </div>
            <button type="submit" class="btn btn-primary">{{isset($post) ? 'Update Post' : 'Add Post'}}</button>
        </form>
    </div>
  </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#publish_at',{
            enableTime:true
        });
    </script>
@endsection