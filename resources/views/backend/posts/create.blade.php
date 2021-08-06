@extends('backend.app')
@section('title', 'Add New Post')

@section('main-content')
    <x-error-msg />
    <x-success-msg />

    <div class="container">
        @yield('main-content')

        <div class="d-flex justify-content-between align-items-center my-4">
            <h2>Add New Post</h2>
            <a class="btn btn-info" href="{{ route('admin.post.index') }}">Manage Posts</a>
        </div>

        <form method="post" action="{{ route('admin.post.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="category" class="form-label">Categories</label>
                <select name="category" id="category" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->cat_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="" cols="30" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="img" name="image">
            </div>
            <div class="mb-3">
                <label for="" class="d-block">Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="active" value="Active">
                    <label class="form-check-label" for="active">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inactive" value="inactive">
                    <label class="form-check-label" for="inactive">Inactive</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>

    </div>

@endsection







