{{-- @break($key == 2) --}}
{{-- @continue($key == 1) --}}

{{-- <div>{{ $key }}. {{ $post['title'] }}</div> --}}

@if ($loop->even)
  <div>{{ $key }}. {{ $post['title'] }}</div>
@else
  <div style="background-color: silver">{{ $key }}. {{ $post['title'] }}</div>
@endif
