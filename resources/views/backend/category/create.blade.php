@extends('backend.app')
@section('title', 'Add New Category')

@section('main-content')

    {{--{{ cat_success_msg(); }}--}}

    {{--<x-error-msg />--}}

    <x-success-msg />

    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>Add New Category</h2>
        <a class="btn btn-info" href="{{ route('admin.category.index') }}">Manage Categories</a>
    </div>

    <form action="{{ route('admin.category.store') }}" method="post">
        @csrf
        <table class="table table-bordered">
            <tr>
                <td>
                    <label for="name">Category Name</label>
                </td>
                <td>
                    <input type="text" id="name" name="cat_name" value="{{ old('cat_name') }}">
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <label><input type="radio" value="active" {{ old('status') === 'active' ? 'checked':'' }} name="status"> Active</label>
                    <label><input type="radio" value="inactive" {{ old('status') === 'inactive' ? 'checked':'' }} name="status"> Inactive</label>
                </td>
            </tr>
        </table>

        <button type="submit">Create Category</button>

    </form>

@endsection
