<select
    name="{{ $name }}"
    {{ $attributes ->class([
        'form-control',
        'form-select',
        'is-invalid' => $errors->has($name)
    ])}}>
    @foreach ($countries as $value=>$text )
    <option value="{{$value}}">{{$text}}</option>
      @endforeach
</select>
