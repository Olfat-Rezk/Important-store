@props(['name', 'options', 'checked' => false, 'label' => false])
<div class="form-group">
    <label for="name">{{ $label }}</label>
    @foreach ($options as $value => $text)
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="{{ $name }}" value="{{ $value }}"
                    @checked(old($name, $checked) == $value)>
                <label class="form-check-label" for="exampleRadios1">
                    {{ $value }}
                </label>
            </div>
    @endforeach
</label>
</div>

