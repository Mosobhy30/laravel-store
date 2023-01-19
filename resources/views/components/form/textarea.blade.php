@props([
    'name',
    'value' => '',
    'labels' => false
])
@if ($labels)
<label for="">{{ $labels }}</label>
@endif

<textarea name="{{ $name }}"
{{ $attributes->class([
    'form-control',
     'is-invalid' => $errors->has($name)
     ]) }}
      >{{ old($name, $value) }}</textarea>

             

    @error($name)
        <div class="invalid-feedback d-block" role="alert">
            {{ $message }}
        </div>
    @enderror