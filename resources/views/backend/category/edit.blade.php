@extends('backend.app')
@section('title', 'Edit Category')

@section('main-content')

    {{--{{ cat_success_msg(); }}--}}

    {{--<x-error-msg />--}}

    <x-success-msg />

    <form action="{{ route('admin.category.update', $category->id) }}" method="post">
        @csrf
        @method('put')
        <table>
            <tr>
                <td>
                    <label for="name">Category Name</label>
                </td>
                <td>
                    <input type="text" id="name" name="cat_name" value="{{ $category->cat_name }}">
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                    <label><input type="radio" value="active" {{ $category->status === 'active' ? 'checked':'' }} name="status"> Active</label>
                    <label><input type="radio" value="inactive" {{ $category->status === 'inactive' ? 'checked':'' }} name="status"> Inactive</label>
                </td>
            </tr>
        </table>

        <button type="submit">Update</button>

    </form>

@endsection

