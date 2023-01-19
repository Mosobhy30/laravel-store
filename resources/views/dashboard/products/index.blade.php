@extends('layouts.dashboard')

@section('title', 'Products')

@section('content')
    <div class="mb-5">
        <a href="{{ route('products.create') }}" class="btn btn-sm btn-outline-primary">Create Product</a>
    </div>

<x-alert type="success"></x-alert>   
<x-alert type="info"></x-alert>   

<form action="{{URL::current()}}" method="get" class="mb-3 d-flex justify-content-between">
<x-form.input  value="{{request('name')}}" name="name"   placeholder="Name" 
/>
<select name="status" class="mx-2 form-control">
    <option value="" >All</option>
    <option value="active" @selected(request('status') == 'active')>Active</option>
    <option value="archived" @selected(request('status') == 'archived')>Archived</option>
</select>
<button type="submit" class="mx-2 btn btn-dark">Filter</button>
</form>
    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Store</th>
                <th>Created At</th>
                <th>Status</th>
                <th colspan="2">Actions</th>

            </tr>
        </thead>
        <tbody>
            @if ($products->count())
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <img src="{{asset('storage/' . $product->image)}}" alt="" height="40">
                        </td>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name}}</td> <!--from relation -->
                        <td>{{ $product->store->name}}</td> <!--from relation --> 
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->status}}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="btn btn-sm btn-outline-success">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>

                            </form>
                        </td>


                    </tr>
                @endforeach
            @else
                <td colspan="7">Nothing Here</td>
            @endif
        </tbody>
    </table>
    {{ $products->withquerystring()->links()}}  
    </div>
@endsection
