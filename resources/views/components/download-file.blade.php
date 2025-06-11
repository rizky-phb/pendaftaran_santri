
@if (!empty($file))

    <a href={{ asset('storage/' . (is_callable($file) ? $file() : $file)) }} download class=filament-button filament-button--link>

        Download File

    </a>

@else

    <span class=text-gray-400>No file uploaded</span>

@endif
