@props(['name', 'value' => '', 'label' => false])
@if ($label)
    <label for="">{{ $label }}</label>
@endif
<textarea name={{ $name }} @class(['form-control', 'is-invalid' => $errors->has($name)]) {{ $attributes }}>
{{ old($name, $value) }}
</textarea>

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
