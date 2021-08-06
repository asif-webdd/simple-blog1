@extends('backend.app')
@section('title', 'Posts')

@section('main-content')

<div class="container">
    @yield('main-content')

    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>Manage Posts</h2>
        <a class="btn btn-info" href="{{ route('admin.post.create') }}">Add New Post</a>
    </div>

    <x-success-msg />
    <x-error-msg />

    <table class="table table-bordered">
        <tr>
            <th>SL</th>
            <th>Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Image</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        @foreach($posts as $post)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->description }}</td>
                <td>{{ $post->category->cat_name }}</td>
                <td><img width="150px;" src="{{ asset('uploads/posts/'. $post->image) }}" alt=""></td>
                <td>{{ ucfirst($post->status) }}</td>
                <td>
                    <a href="{{ route('admin.post.edit', $post->id) }}">Edit</a>
                    <a href="{{ route('admin.post.show', $post->id) }}">Show</a>
                    <form action="{{ route('admin.post.destroy', $post->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        {{--<button type="submit" name="submit">Delete</button>--}}
                        <a href="{{ route('admin.post.destroy', $post->id) }}" onclick="event.preventDefault(); this.closest('form').submit()">Delete</a>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>

@endsection







