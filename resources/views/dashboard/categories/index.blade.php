@extends('layouts.dashboard')

@section('title', 'Categories')

@section('content')
<div class="mb-5">
    <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">Create Category</a>
    <a href="{{ route('categories.trash') }}" class="ml-3 btn btn-sm btn-outline-dark">Trash</a>
</div>

<x-alert type="success"></x-alert>
<x-alert type="info"></x-alert>

<form action="{{URL::current()}}" method="get" class="mb-3 d-flex justify-content-between">
    <x-form.input value="{{request('name')}}" name="name" placeholder="Name" />
    <select name="status" class="mx-2 form-control">
        <option value="">All</option>
        <option value="active" @selected(request('status')=='active' )>Active</option>
        <option value="archived" @selected(request('status')=='archived' )>Archived</option>
    </select>
    <button type="submit" class="mx-2 btn btn-dark">Filter</button>
</form>
<table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>ID</th>
            <th>Name</th>
            <th>Product #</th>
            <th>Parent</th>
            <th>Created At</th>
            <th>Status</th>
            <th colspan="2">Actions</th>

        </tr>
    </thead>
    <tbody>
        @forelse ($categories as $category)
        <tr>
            <td>
                <img src="{{asset('storage/' . $category->image)}}" alt="" height="40">
            </td>
            <td>{{ $category->id }}</td>
            <td><a href="{{route('categories.show', $category->id)}}">{{ $category->name }}</a></td>
            <td>{{ $category->products_count }}</td>
            <td>{{ $category->parent->name}}</td>
            <td>{{ $category->created_at }}</td>
            <td>{{ $category->status}}</td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>

                </form>
            </td>


        </tr>

        @empty
        <td colspan="7">Nothing Here</td>
        @endforelse
    </tbody>
</table>
{{ $categories->withquerystring()->links()}}
</div>
@endsection