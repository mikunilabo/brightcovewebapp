<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroupFile">@lang ('File selection')</span>
    </div>
    <div class="custom-file">
        <input name="{{ $attribute }}" type="file" id="{{ $attribute }}" class="custom-file-input {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" aria-describedby="inputGroupFile" {{ empty($required) ? '' : 'required' }} />
        <label class="custom-file-label" id="custom-file-label" for="{{ $attribute }}" data-browse="@lang ('Reference')">@lang ('File not selected')</label>
    </div>
    @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
</div>
