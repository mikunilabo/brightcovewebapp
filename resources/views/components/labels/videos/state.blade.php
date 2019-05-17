@if (! empty($state) )
    <div class="lead">
        <span class="text-{{ $state === 'ACTIVE' ? 'success' : ($state === 'INACTIVE' ? 'danger' : '-') }} icons icon-{{ $state === 'ACTIVE' ? 'check' : ($state === 'INACTIVE' ? 'ban' : '-')  }}"></span>
    </div>
@endif
