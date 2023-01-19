@extends('layouts.dashboard')

@section('title', 'Create category')

@section('content')

    <form action="{{ route('categories.store') }}" method="post" 
    enctype="multipart/form-data">
    
      @csrf
      @include('dashboard.categories._form',
      [
        'button_label' => 'Create'
      ])
    </form>
  </div>
</div>


@endsection
