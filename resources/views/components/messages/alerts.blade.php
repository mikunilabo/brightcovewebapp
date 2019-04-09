@foreach (['success', 'info', 'warning', 'danger'] as $name)
    @continue (! session()->has("alerts.{$name}"))

    @foreach (session()->get("alerts.{$name}") as $message)
        <div class="alert alert-{{ $name }} alert-dismissible fade show" role="alert">
            {{ $message }}

            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endforeach
@endforeach
