@extends('layouts.dashboard')

@section('title', 'Edit Profile')

@section('content')

<x-alert type="success"></x-alert>

<form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('patch')

    <div class="form-row">
        <div class="col-md-6">
            <x-form.input labels="First Name" name="first_name" :value="$user->profile->first_name" />
        </div>
        <div class="col-md-6">
            <x-form.input labels="Last Name" name="last_name" :value="$user->profile->last_name" />
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <x-form.input labels="Birthday" type="date" name="birthday" :value="$user->profile->birthday" />
        </div>
        <div class="col-md-6">
            <x-form.radio name="gender" label="Gender" :options="['male'=>'Male','female'=>'Female']" />
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-4">
            <x-form.input labels="Street Address" name="street_address" :value="$user->profile->street_address" />
        </div>
        <div class="col-md-4">
            <x-form.input labels="City" name="city" :value="$user->profile->city" />
        </div>
        <div class="col-md-4">
            <x-form.input labels="State" name="state" :value="$user->profile->state" />
        </div>
    </div>
    <div class="form-row mb-3">
        <div class="col-md-4">
            <x-form.input labels="Postal Code" name="postal_code" :value="$user->profile->postal_code" />
        </div>
                {{-- {{-- <div class="col-md-4">
                    <x-form.select label="Country" name="country" options="{{['ar' => 'Ar','en' => 'En']}}"
                        :selected="$user->profile->country" />
                </div> --}}
                {{-- <div class="col-md-4">

                    <x-form.select label="local" name="local" :countries="$countries" />
                </div>

                <div> --}}
            <div class="col-md-4">
                <label>Country</label>
                <select name="country" class="form-control">
                    @foreach ($countries as $value=>$text )
                    <option value="{{$value}}">{{$text}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Local</label>
                <select name="local" class="form-control">
                    @foreach ($local as $value=>$text )
                    <option value="{{$value}}">{{$text}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-row">
                <button type="submit" class="btn btn-primary ">Save</button>

            </div>
            </div>

</form>

</div>
</div>


@endsection