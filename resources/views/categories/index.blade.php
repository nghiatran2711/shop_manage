@extends('layouts.master')
@section('title','List Category')
@section('content')
    <h1>List Category</h1>
    {{-- show message --}}
    @if(Session::has('success'))
        <p class="text-success">{{ Session::get('success') }}</p>
    @endif

    {{-- show error message --}}
    @if(Session::has('error'))
        <p class="text-danger">{{ Session::get('error') }}</p>
    @endif

    <a href="{{ route('category.create') }}" class="btn btn-primary">Create Category</a>
    <table class="table table-striped table-inverse">
        <thead class="thead-inverse">
            <tr>
                <th>#</th>
                <th>Category ID</th>
                <th>Category Name</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ( $categories as $key => $category )
                <tr>
                    <td scope="row">{{ $key+1 }}</td>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td><a href="">Details</a></td>
                    <td><a href="{{ route('category.edit',$category->id) }}">Edit</a></td>
                    <td>
                        <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </table>
@endsection