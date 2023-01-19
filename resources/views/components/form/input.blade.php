@props([
    'type' => 'text',
    'name',
    'value' => ' ',
    'labels' => false
])
@if ($labels)
<label>{{$labels}}</label>
@endif

<input
 name="{{ $name }}"
 type="{{ $type }}" 
 value="{{ old($name , $value) }}"
{{ $attributes->class([
    'form-control',
     'is-invalid' => $errors->has($name)
     ]) }}
      >
             

    @error($name)
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
    @enderror