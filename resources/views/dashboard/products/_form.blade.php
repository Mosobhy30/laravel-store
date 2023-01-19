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
    <x-form.input labels="Product Name" name="name" value="{{$product->name}}" />
</div>

<div class="form-group">
    <div class="col-sm-10">
        <x-form.textarea labels="Description" name="description" value="{{$product->description}}" />
    </div>
</div>
<div class="form-group">
    <label for="">Parent</label>
    <div class="col-sm-10">
        <select name="category_id">
            <option value="">Primary Category</option>
            @foreach (App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" @selected(old('category_id',$product->category_id) == $category->id)>
                {{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-10">
        <x-form.input labels="Image" type="file" name="image" accept="image/*" />
    </div>
    @if ($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" alt="" height="40">
    @endif
</div>
<div class="form-group">

    <x-form.radio name="status" label="Status" checked="{{$product->status}}"
        :options="['active'=>'Active','draft'=>'Draft','archived'=>'Archived']" />
</div>

<div class="form-group">
    <x-form.input labels="Price" name="price" value="{{$product->price}}" />
</div>
<div class="form-group">
    <x-form.input labels="Compare Price" name="compare_price" value="{{$product->compare_price}}" />
</div>
<div class="form-group">
    <x-form.input labels="Tag" name="tags" value="{{ $tags }}" />
</div>


<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
</div>