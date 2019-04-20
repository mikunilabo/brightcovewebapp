@if ($errors->{$errorBag ?? 'default'}->has($name))
    <span class="invalid-feedback" role="alert" style="display: block;">
        <strong>{{ $errors->{$errorBag ?? 'default'}->first($name) }}</strong>
    </span>
@endif
