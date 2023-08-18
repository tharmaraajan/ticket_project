@props(['value'])

<label style="text-shadow: 2px  2px black;font-size: 30px;color: white" {{ $attributes->merge(['class' => 'block font-medium text-lg text-black-700 light:text-black-300']) }}>
    {{ $value ?? $slot }}
</label>
