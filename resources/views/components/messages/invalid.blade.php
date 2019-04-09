@if ($errors->{empty($errBag) ? 'default' : $errBag}->has($name))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->first($name) }}</strong>
    </span>
@endif
