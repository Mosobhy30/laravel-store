
@props([
    'name',
    'options',
    'selected' =>false,
])
<select>
@foreach( $options as $value=>$text )
        


<option value="{{ $value }}" @selected($value == $selected)>{{ $text }}</option>    @endforeach

    <label class="form-check-label">{{$value}}</label>
</div>
@endforeach
</select>
   