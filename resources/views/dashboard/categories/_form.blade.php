@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <h3>Error!!</h3>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif

<div class="form-group">
    <x-form.input labels="Namee" name="name" value="{{$category->name}}" />


</div>

<div class="form-group">
    <div class="col-sm-10">

        <x-form.textarea labels="Description" name="description" value="{{$category->description}}" />
    </div>
</div>
<div class="form-group">
    <label for="">Parent</label>
    <div class="col-sm-10">
        <select name="parent_id">
            <option value="">Primary Category</option>
            @foreach ($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id',$category->parent_id) == $parent->id)>
                {{ $parent->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-10">
        <x-form.input labels="Image" type="file" name="image" accept="image/*" />
    </div>
    @if ($category->image)
    <img src="{{ asset('storage/' . $category->image) }}" alt="" height="40">
    @endif
</div>
<div class="form-group">
    <label for="">Status</label>
    <div class="form-check">
        <input name="status" class="form-check-input" type="radio" name="status" value="active" @checked(old( 'status' ,
            $category->status ) == 'active') >
        <label class="form-check-label">Active</label>
    </div>
    <div class="form-check">
        <input name="status" class="form-check-input" type="radio" name="status" value="archived" @checked(old( 'status'
            , $category->status ) == 'archived') >
        <label class="form-check-label">Archived</label>
    </div>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>