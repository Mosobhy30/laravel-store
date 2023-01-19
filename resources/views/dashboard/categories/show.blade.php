@extends('layouts.dashboard')

@section('title', $category->name)

@section('content')

<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>store</th>
            <th>Created At</th>
            <th>Status</th>

        </tr>
    </thead>
    <tbody>
        @php
            $products=$category->products()->with('store')->paginate(5);
        @endphp
        @forelse ( $products as $product)
        <tr>
            <td>
                <img src="{{asset('storage/' . $product->image)}}" alt="" height="40">
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->store->name }}</td>
            <td>{{ $product->created_at }}</td>
            <td>{{ $product->status}}</td>

        </tr>
        @empty
        <td colspan="7">Nothing Here</td>
        @endforelse
    </tbody>
</table>
{{ $products->links()}}
</div>
@endsection