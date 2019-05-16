<span class="invalid-feedback d-block" id="{{ sprintf('invalid-feedback-%s', $name) }}" role="alert">
    @if ($errors->{$errorBag ?? 'default'}->has($name))
        <strong>{{ $errors->{$errorBag ?? 'default'}->first($name) }}</strong>
    @endif
</span>
