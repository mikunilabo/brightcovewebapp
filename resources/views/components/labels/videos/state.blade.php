@if (! empty($state) )
    <div>
        <span class="badge badge-sm badge-{{ $state === 'ACTIVE' ? 'success' : ($state === 'INACTIVE' ? 'light' : '-')  }}">@lang ($state)</span>
    </div>
@endif
