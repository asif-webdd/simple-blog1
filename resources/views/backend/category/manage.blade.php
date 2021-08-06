@extends('backend.app')
@section('title', 'Categories')

@section('main-content')

    {{--{{ cat_success_msg(); }}--}}

    {{--<x-error-msg />--}}

    <x-success-msg />

    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>Manage Categories</h2>
        <a class="btn btn-info" href="{{ route('admin.category.create') }}">Add New Category</a>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        @foreach($categories as $category)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ $category->cat_name }}</td>
                <td>{{ ucfirst($category->status) }}</td>
                <td>
                    <a href="{{ route('admin.category.edit', $category->id) }}">Edit</a>
                    <a href="{{ route('admin.category.show', $category->id) }}">Show</a>
                    <form action="{{ route('admin.category.destroy', $category->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        {{--<button type="submit" name="submit">Delete</button>--}}
                        <a href="{{ route('admin.category.destroy', $category->id) }}" onclick="event.preventDefault(); this.closest('form').submit()">Delete</a>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
