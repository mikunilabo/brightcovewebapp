@if (! empty($state) )
    <div class="lead">
        <span class="badge badge-{{ $state === 'ACTIVE' ? 'success' : ($state === 'INACTIVE' ? 'secondary' : '-')  }}">@lang ($state)</span>
    </div>
@endif
