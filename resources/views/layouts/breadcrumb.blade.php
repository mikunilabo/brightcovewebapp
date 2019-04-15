<!-- Breadcrumb-->
<ol class="breadcrumb">
    @foreach (array_merge([__('Home') => route('home')], $lists ?? []) as $key => $item)
        @if (is_null($item) || $loop->last)
            <li class="breadcrumb-item active">{{ $key }}</li>
        @else
            <li class="breadcrumb-item">
                <a href="{{ $item }}">{{ $key }}</a>
            </li>
        @endif
    @endforeach

    <!-- Breadcrumb Menu-->
    <li class="breadcrumb-menu d-md-down-none">
        <div class="btn-group" role="group" aria-label="Button group">
            <a class="btn" href="#">
                <i class="icon-settings"></i> @lang ('Settings')
            </a>
        </div>
    </li>
</ol>
