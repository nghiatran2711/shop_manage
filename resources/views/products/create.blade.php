@extends('layouts.master')
@section('title','Create Category')
@section('content')
    <h1>Create Product</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <fieldset class="form-group" >
            <label for="exampleInputEmail1">Product Name</label>
            <input type="text" name="name" class="form-control" class="@error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter product name">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </fieldset>
        <fieldset class="form-group" >
            <label for="exampleInputEmail1">Description</label>
            <input type="text" name="description" class="form-control" class="@error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter description">
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </fieldset>
        <fieldset class="form-group">
            <label for="exampleInputFile">Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control-file" id="exampleInputFile">
            @error('thumbnail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </fieldset>
       
        <fieldset class="form-group">
            <label for="exampleSelect1">Category</label>
            <select class="form-control" id="eexampleSelect11" name="category_id">
                <option></option>
                @foreach ($categories as $category_id => $name )
                <option value="{{ $category_id }}">{{ $name }}</option>
                @endforeach
                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </select>
        </fieldset>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection