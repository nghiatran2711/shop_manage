@extends('layouts.master')
@section('title','Edit Product')
@section('content')
    <h1>Edit Product</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <fieldset class="form-group" >
            <label for="exampleInputEmail1">Product Name</label>
            <input type="text" name="name" class="form-control" class="@error('title') is-invalid @enderror" id="exampleInputEmail1" value="{{ $product->name }}">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </fieldset>
        <fieldset class="form-group" >
            <label for="exampleInputEmail1">Description</label>
            <input type="text" name="description" class="form-control" class="@error('title') is-invalid @enderror" id="exampleInputEmail1" value="{{ $product->description }}">
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </fieldset>
        <fieldset class="form-group">
            <label for="exampleInputFile">Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control-file" id="exampleInputFile">
            <img src="{{ asset($product->thumbnail ) }}" alt="" width="100px">
            @error('thumbnail')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </fieldset>
       
        <fieldset class="form-group">
            <label for="exampleSelect1">Category</label>
            <select class="form-control" id="eexampleSelect11" name="category_id">
                <option></option>
                @foreach ($categories as $category_id => $name )
                    <option value="{{ $category_id }}" {{ old('category_id',$product->category_id)==$category_id ? 'selected' : null }}>{{ $name }}</option>
                @endforeach
                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </select>
        </fieldset>
        <button type="submit" class="btn btn-primary">Update product</button>
    </form>
@endsection