@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <h1 class="h1">Admin - All Posts</h1>
        </div>
        <div class="row">
            <div class="col mt-4 mb-4">
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add new Post</a>
            </div>
        </div>
         <div class="row">
            <div class="col">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
                 <table class="table table-warning">
                    <thead>
                        <tr class="table-danger">
                            <th>Title</th>
                            <th>Content</th>
                            <th>Slug</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->content }}</td>
                            <td>{{ $post->slug }}</td>
                            <td><a class="btn btn-primary" href="{{ route('admin.posts.show', $post) }}">View</a></td>
                            <td><a class="btn btn-primary" href="{{ route('admin.posts.edit', $post) }}">Edit</a></td>
                            <td>
                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger" type="submit" value="Delete">
                                </form> 
                            </td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection    