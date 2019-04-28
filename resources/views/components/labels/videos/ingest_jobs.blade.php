@if (count($items = collect($items)))

@php
    $item = $items->sortByDesc('updated_at')->first();
    $state = $item['state'];
@endphp

    <div>
        <span class="badge badge-sm badge-{{ $state === 'processing' ? 'warning' : ($state === 'publishing' || $state === 'published' ? 'success' : ($state === 'finished' ? 'success' : ($state === 'failed' ? 'danger' : '-')))  }}">@lang ($state)</span>
    </div>
@else
    -
@endif
