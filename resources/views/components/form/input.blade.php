@props(['name', 'type' => 'text', 'value' => ""])
<div>
    <input type="{{ $type }}" {{ $attributes }} name="{{ $name }}"
        value="{{$value}}" id="">
</div>
