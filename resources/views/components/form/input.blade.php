@props([
    'type'=>'text','name','value'=>'','label' =>false
])
@if ($label)
<label for="">{{$label}}</label>

@endif
<input
type={{ $type }}
 name={{ $name}}
        @class(['form-control', 'is-invalid' => $errors->has($name)])
        value="{{old($name,$value ) }}"
        {{$attributes}} >

    @error($name)
    <div class="invalid-feedback">{{ $message }}</div>

    @enderror
