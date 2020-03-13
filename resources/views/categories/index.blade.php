@extends('layouts.app')


@section('content')


    <div class="d-flex justify-content-end mb-2 mt-2">
    <a href="{{route('categories.create')}}"><div class="btn btn-primary">Add Category</div></a>
    </div>

    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Category</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <th scope="row">{{$category->name}}</th>
                <td><a href="{{route('categories.edit',$category->id)}}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                </td>

            </tr>
            @endforeach
        </tbody>
      </table>

@endsection
