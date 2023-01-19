@extends('layouts.dashboard')

@section('title', 'trash')

@section('content')
    <div class="mb-5">
        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-primary">Back</a>
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
                <th>Parent</th>
                <th>Deleted At</th>
                <th>Status</th>
                <th colspan="2">Actions</th>

            </tr>
        </thead>
        <tbody>
            @if ($categories->count())
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            <img src="{{asset('storage/' . $category->image)}}" alt="" height="40">
                        </td>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->parent_name}}</td>
                        <td>{{ $category->deleted_at }}</td>
                        <td>{{ $category->status}}</td>
                        <td>
                            <form action="{{ route('categories.restore', $category->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-sm btn-outline-success">Restore</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('categories.forceDelete', $category->id) }}" method="post">
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
    {{ $categories->withquerystring()->links()}}  
    </div>
@endsection
