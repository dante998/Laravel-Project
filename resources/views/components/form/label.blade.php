@props([
    'value'
])

<div>

    <label>{{ $value ?? $slot }}</label>

</div>