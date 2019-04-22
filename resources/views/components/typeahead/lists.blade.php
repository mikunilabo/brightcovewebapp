<div class="row" id="{{ sprintf('%s-area', $attribute) }}">
    <div class="form-group col-md-12">
        <label for="{{ $attribute }}">@lang (ucfirst($attribute))</label>

        @if (request()->route()->named(['accounts.create', 'accounts.detail']))
            <i class="icons icon-question text-warning" data-toggle="popover" data-trigger="hover" data-container="body" data-html="true" data-content="@lang ('It will be automatically selected when uploading.')<br>@lang ('If it is not in the list, it will be newly registered.')<br>@lang ('Multiple selections are possible.')"></i>
        @endif
    </div>

    @foreach ($items as $key => $value)
        <div class="form-group col-md-6" id="{{ $id = sprintf('%s-list-%s', $attribute, $key) }}">
            <div class="input-group">
                <input name="{{ sprintf('%s[%s]', $attribute, $key) }}" type="text" value="{{ $value }}" class="form-control {{ sprintf('ta-%s', $attribute) }} {{ $errors->{$errorBag ?? 'default'}->has(sprintf('%s.%s', $attribute, $key)) ? 'is-invalid' : '' }}" placeholder="" autocomplete="off" />
                <span class="input-group-append">
                    <button class="btn btn-outline-danger" type="button" onclick="window.Common.removeElement('{{ $id }}')">
                        <i class="icons icon-close"></i>
                    </button>
                </span>
            </div>
            @component ('components.messages.invalid', ['name' => sprintf('%s.%s', $attribute, $key)]) @endcomponent
        </div>
    @endforeach

    <div class="form-group col-md-6" id="{{ sprintf('%s-add-btn-area', $attribute) }}">
        <button class="btn btn-block btn-outline-success" type="button" onclick="window.Common.createTypeAheadList('{{ $attribute }}')">
            <i class="icons icon-plus"></i>
        </button>
    </div>

    <input type="hidden" id="{{ sprintf('%s-list-cnt', $attribute) }}" value="{{ collect($items)->keys()->max() + 1 }}">
</div>
