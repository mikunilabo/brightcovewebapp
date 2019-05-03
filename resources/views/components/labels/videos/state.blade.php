@if (! empty($state) )
    <div>
        <span class="badge badge-{{ $state === 'ACTIVE' ? 'success' : ($state === 'INACTIVE' ? 'light' : '-')  }}">@lang ($state)</span>
    </div>
@endif
