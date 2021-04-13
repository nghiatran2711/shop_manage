@extends('layouts.master')
@section('title','Create Category')
@section('content')
    <h1>Create Category</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('category.store') }}" method="POST">
        @csrf
        <fieldset class="form-group" >
            <label for="exampleInputEmail1">Category Name</label>
            <input type="text" name="name" class="form-control" class="@error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter category name">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </fieldset>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection