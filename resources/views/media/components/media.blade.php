<div class="row">
    @if (empty($row))
        <div class="form-group col-md-6">
            @set ($attribute, 'video_file')
            <label for="{{ $attribute }}">@lang ('Video File') <code>*</code></label>

            @component ('components.popovers.informations', ['content' => '20MB']) @endcomponent

            <div>
                <input type="file" id="{{ $attribute }}" class="{{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" required />
                @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
            </div>
        </div>
    @else
        <div class="form-group col-md-6">
            @component ('components.videos.players.videocloud', ['videoId' => $row->id, 'accountId' => config('services.videocloud.account_id')]) @endcomponent
        </div>
    @endif
</div>

@if (! empty($row))
    <div class="row">
        <div class="form-group col-md-6">
            @set ($attribute, 'id')
            <label for="{{ $attribute }}">@lang ('ID')</label>
            <div><code>{{ $row->{$attribute} }}</code></div>
        </div>
        <div class="form-group col-md-6">
            @set ($attribute, 'uuid')
            <label for="{{ $attribute }}">@lang ($attribute)</label>
            <div><code>{{ ! empty($row->custom_fields) && is_array($row->custom_fields) && array_key_exists($attribute, $row->custom_fields) ? $row->custom_fields[$attribute] : null }}</code></div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            @set ($attribute, 'state')
            <label for="{{ $attribute }}">@lang ('Status')</label>
            @component ('components.labels.videos.state', ['state' => $row->{$attribute}]) @endcomponent
        </div>
        <div class="form-group col-md-6">
            @set ($attribute, 'ingestjobs')
            <label for="{{ $attribute }}">@lang ('Ingest Status')</label>
            <div class="lead">
                <span id="ingestjobs_result" class="badge badge-light">@lang ('There is no jobs')</span>
                <button type="button" class="btn btn-sm btn-outline-warning" onclick="ingestjobs();">
                    <i class="icons icon-refresh"></i> @lang ('Update')
                </button>
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="form-group col-md-6">
        @set ($attribute, 'name')
        <label for="{{ $attribute }}">@lang ('Title') <code>*</code></label>
        <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="1" placeholder="" autocomplete="off" required>{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} ?? null }}</textarea>
        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
    </div>
    <div class="form-group col-md-6">
        <label for="{{ $attribute }}">@lang ('Implementation Date')</label>

        <div class="input-prepend input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="icons icon-calendar"></i>
                </span>
            </div>

            @set ($attribute, 'date')
            <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : ( ! empty($row->custom_fields) && is_array($row->custom_fields) && array_key_exists($attribute, $row->custom_fields) ? $row->custom_fields[$attribute] : null ) }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="10" placeholder="YYYY-MM-DD" autocomplete="off" />
            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        @set ($attribute, 'description')
        <label for="{{ $attribute }}">@lang ('Description')</label>
        <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="5" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} ?? null }}</textarea>
        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
    </div>
    <div class="form-group col-md-6">
        @set ($attribute, 'long_description')
        <label for="{{ $attribute }}">@lang ('Keywords')</label>
        <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="5" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} ?? null }}</textarea>
        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label for="{{ $attribute }}">@lang ('Starts At')</label>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="icons icon-calendar"></i>
                </span>
            </div>

            @set ($attribute, 'starts_at')
            <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : ( ! empty($row->schedule) && is_array($row->schedule) && array_key_exists($attribute, $row->schedule) ? now()->parse($row->schedule[$attribute])->setTimezone(config('app.timezone')) : null ) }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="16" placeholder="YYYY-MM-DD HH:MM" autocomplete="off" />
            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="{{ $attribute }}">@lang ('Ends At')</label>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="icons icon-calendar"></i>
                </span>
            </div>

            @set ($attribute, 'ends_at')
            <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : ( ! empty($row->schedule) && is_array($row->schedule) && array_key_exists($attribute, $row->schedule) ? now()->parse($row->schedule[$attribute])->setTimezone(config('app.timezone')) : null ) }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="16" placeholder="YYYY-MM-DD HH:MM" autocomplete="off" />
            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        @set ($attribute, 'rightholder')
        <label for="{{ $attribute }}">@lang ('Rightholder')</label>
        <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : ( ! empty($row->custom_fields) && is_array($row->custom_fields) && array_key_exists($attribute, $row->custom_fields) ? $row->custom_fields[$attribute] : null ) }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="" autocomplete="off" />
        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
    </div>
    <div class="form-group col-md-6">
        @set ($attribute, 'tournament')
        <label for="{{ $attribute }}">@lang ('Tournament')</label>
        <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : ( ! empty($row->custom_fields) && is_array($row->custom_fields) && array_key_exists($attribute, $row->custom_fields) ? $row->custom_fields[$attribute] : null ) }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="" autocomplete="off" />
        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
    </div>
</div>

@if (empty($row))
    @foreach (['leagues' => Auth::user()->leagues, 'universities' => Auth::user()->universities, 'sports' => Auth::user()->sports] as $attribute => $items)
        @include ('components.typeahead.lists', ['attribute' => $attribute, 'items' => $errors->{$errorBag ?? 'default'}->any() ? old($attribute, []) : $items->pluck('name')->all()])
        <hr>
    @endforeach
@else
    @foreach (['leagues' => $vc_leagues, 'universities' => $vc_universities, 'sports' => $vc_sports] as $attribute => $items)
        @include ('components.typeahead.lists', ['attribute' => $attribute, 'items' => $errors->{$errorBag ?? 'default'}->any() ? old($attribute, []) : collect($row->tags)->filter(function ($value) use ($items) { return $items->containsStrict('name', $value); })])
        <hr>
    @endforeach

    <div class="row">
        <div class="form-group col-md-6">
            @set ($attribute, 'created_at')
            <label for="{{ $attribute }}">@lang ('Created At')</label>
            <div>{{ is_null($row->{$attribute}) ? null : now()->parse($row->{$attribute})->setTimezone(config('app.timezone')) }}</div>
        </div>
        <div class="form-group col-md-6">
            @set ($attribute, 'updated_at')
            <label for="{{ $attribute }}">@lang ('Updated At')</label>
            <div>{{ is_null($row->{$attribute}) ? null : now()->parse($row->{$attribute})->setTimezone(config('app.timezone')) }}</div>
        </div>
    </div>
@endif
