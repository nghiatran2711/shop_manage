@extends('layouts.master')
@section('title','List Product')
@section('content')  
    <h1>List Product</h1>
    @include('products.search')
    <a href="{{ route('product.create') }}" class="btn btn-primary">Create Product</a>
    {{-- show message --}}
    @if(Session::has('success'))
        <p class="text-success">{{ Session::get('success') }}</p>
    @endif

    {{-- show error message --}}
    @if(Session::has('error'))
        <p class="text-danger">{{ Session::get('error') }}</p>
    @endif
    <table class="table table-striped table-inverse">
        <thead class="thead-inverse">
            <tr>
                <th>#</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Thumpnail</th>
                <th>Category</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ( $products as $key => $product )
                <tr>
                    <td scope="row">{{ $key+1 }}</td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td style="width:500px;white-space: normal;word-break: break-all">{{ $product->description }}</td>
                    <td><img src="{{ asset($product->thumbnail ) }}" alt="" width="100px"></td>
                    <td>{{ $product->category->name }}</td>
                    <td><a href="">Details</a></td>
                    <td><a href="{{ route('product.edit',$product->id) }}">Edit</a></td>
                    <td>
                        <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
    </table>
    {{ $products->appends(request()->input())->links() }}
@endsection