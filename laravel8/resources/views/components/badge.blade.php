@props(['type' => 'info', 'message'])

<div {{ $attributes->merge(['class' => 'badge badge-' . $type]) }}>
    {{ $message }}
</div>
