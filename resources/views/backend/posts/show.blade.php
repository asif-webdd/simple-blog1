@extends('backend.app')
@section('title', 'Posts')

@section('main-content')

    <div class="container">
        @yield('main-content')

        <div class="d-flex justify-content-between align-items-center my-4">
            <h2>Manage Posts</h2>
            <a class="btn btn-info" href="{{ route('admin.post.create') }}">Add New Post</a>
        </div>

        <table class="table table-bordered">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>image</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td><img width="150px;" src="{{ asset('uploads/posts/'. $post->image) }}" alt=""></td>
                <td>{{ ucfirst($post->status) }}</td>
            </tr>
        </table>
    </div>

@endsection







