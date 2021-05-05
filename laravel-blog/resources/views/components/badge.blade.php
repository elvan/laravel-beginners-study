@props(['type' => 'info', 'message', 'show'])

@if (!isset($show) || $show)
    <span {{ $attributes->merge(['class' => 'badge badge-' . $type]) }}>
        {{ $message }}
    </span>
@endif
