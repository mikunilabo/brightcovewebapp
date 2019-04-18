@php
    $errorBag = empty($errorBag) ? 'default' : $errorBag;
@endphp

@if ($errors->{$errorBag}->has($name))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $errors->{$errorBag}->first($name) }}</strong>
    </span>
@endif
