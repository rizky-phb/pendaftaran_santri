
@php
    $field = data_get($getRecord(), $field ?? '');
    $label = $label ?? '';
@endphp

<div>
    <label>{{ $label }}</label>
    @if ($field)
        @php
            $url = asset('storage/' . $field);
            $ext = strtolower(pathinfo($field, PATHINFO_EXTENSION));
        @endphp
        @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
            <div style="margin-top: 8px;">
                <img src="{{ $url }}" alt="{{ $label }}" style="max-width:100px;max-height:100px;border-radius:4px;border:1px solid #eee;cursor:pointer;" onclick="window.open('{{ $url }}', '_blank')" />
                <br>
                <a href="{{ $url }}" target="_blank" style="color: #3b82f6; text-decoration: underline; font-size:12px;">Lihat</a>
            </div>
        @else
            <a href="{{ $url }}" target="_blank" style="color: #3b82f6; text-decoration: underline;">Lihat</a>
        @endif
    @else
        <span>-</span>
    @endif
</div>
