<div class="row">
    @set ($attribute, 'video_file')

    <div class="form-group col-md-6">
        @if (empty($row))
            <label for="{{ $attribute }}">@lang ('Video File') <code>*</code></label>
            @component ('components.inputs.video_file', ['attribute' => $attribute, 'required' => true]) @endcomponent
        @else
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab-player" role="tab" aria-controls="tab-player">@lang ('Player')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-upload" role="tab" aria-controls="tab-upload">@lang ('Re upload')</a>
                </li>
            </ul>

            <div class="tab-content border-0">
                <div class="tab-pane p-0 fade show active" id="tab-player" role="tabpanel">
                    @component ('components.videos.players.videocloud', ['videoId' => $row->id, 'accountId' => config('services.videocloud.account_id')]) @endcomponent
                </div>
                <div class="tab-pane p-0 pt-3 fade" id="tab-upload" role="tabpanel">
                    <label for="{{ $attribute }}">@lang ('Video File')</label>
                    @component ('components.popovers.informations', ['content' => __('If you want to replace the video file, please select again.')]) @endcomponent
                    @component ('components.inputs.video_file', ['attribute' => $attribute, 'required' => false]) @endcomponent
                </div>
            </div>
        @endif
    </div>
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
            <div>
                <label class="switch switch-label switch-pill switch-success">
                    <input name="{{ $attribute }}" type="hidden" value="INACTIVE" checked />
                    <input name="{{ $attribute }}" type="checkbox" value="ACTIVE" class="switch-input" {{ $row->{$attribute} === 'ACTIVE' ? 'checked' : '' }} />
                    <span class="switch-slider" data-checked="@lang ('ACTIVE')" data-unchecked="@lang ('INACTIVE')"></span>
                </label>
            </div>
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
    <div class="form-group col-md-12">
        @set ($attribute, 'name')
        <label for="{{ $attribute }}">@lang ('Title') <code>*</code></label>
        <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} ?? null }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="255" placeholder="" required autofocus />
        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        @set ($attribute, 'description')
        <label for="{{ $attribute }}">@lang ('Description')</label>
        <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="248" rows="4" placeholder="">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} ?? null }}</textarea>
        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
    </div>
    <div class="form-group col-md-6">
        @set ($attribute, 'long_description')
        <label for="{{ $attribute }}">@lang ('Keywords')</label>
        <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="5000" rows="4" placeholder="">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} ?? null }}</textarea>
        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
    </div>
</div>
<div class="row">
    <div class="form-group col-md-3">
        @set ($attribute, 'starts_at')
        <label for="{{ $attribute }}">@lang ('Starts At')</label>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="icons icon-calendar"></i>
                </span>
            </div>

            <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : ( ! empty($row->schedule) && is_array($row->schedule) && array_key_exists($attribute, $row->schedule) ? now()->parse($row->schedule[$attribute])->setTimezone(config('app.timezone'))->format('Y/m/d H:i') : null ) }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="16" placeholder="YYYY/MM/DD HH:MM" />
            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
        </div>
    </div>
    <div class="form-group col-md-3">
        @set ($attribute, 'ends_at')
        <label for="{{ $attribute }}">@lang ('Ends At')</label>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="icons icon-calendar"></i>
                </span>
            </div>

            <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : ( ! empty($row->schedule) && is_array($row->schedule) && array_key_exists($attribute, $row->schedule) ? now()->parse($row->schedule[$attribute])->setTimezone(config('app.timezone'))->format('Y/m/d H:i') : null ) }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="16" placeholder="YYYY/MM/DD HH:MM" />
            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
        </div>
    </div>
    <div class="form-group col-md-3">
        @set ($attribute, 'date')
        <label for="{{ $attribute }}">@lang ('Implementation Date')</label>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="icons icon-calendar"></i>
                </span>
            </div>

            <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : ( ! empty($row->custom_fields) && is_array($row->custom_fields) && array_key_exists($attribute, $row->custom_fields) ? $row->custom_fields[$attribute] : null ) }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="10" placeholder="YYYY/MM/DD" />
            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        @set ($attribute, 'rightholder')
        <label for="{{ $attribute }}">@lang ('Rightholder')</label>
        <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : ( ! empty($row->custom_fields) && is_array($row->custom_fields) && array_key_exists($attribute, $row->custom_fields) ? $row->custom_fields[$attribute] : null ) }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="255" placeholder="" />
        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
    </div>
    <div class="form-group col-md-6">
        @set ($attribute, 'tournament')
        <label for="{{ $attribute }}">@lang ('Tournament')</label>
        <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : ( ! empty($row->custom_fields) && is_array($row->custom_fields) && array_key_exists($attribute, $row->custom_fields) ? $row->custom_fields[$attribute] : null ) }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="255" placeholder="" />
        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
    </div>
</div>

@if (empty($row))
    @foreach (['leagues' => Auth::user()->leagues, 'universities' => Auth::user()->universities, 'sports' => Auth::user()->sports] as $attribute => $items)
        @include ('components.typeahead.lists', ['attribute' => $attribute, 'items' => $errors->{$errorBag ?? 'default'}->any() ? old($attribute, []) : $items->pluck('name')->all()])

        @if (! $loop->last) <hr> @endif
    @endforeach
@else
    @foreach (['leagues' => $vc_leagues, 'universities' => $vc_universities, 'sports' => $vc_sports] as $attribute => $items)
        @include ('components.typeahead.lists', ['attribute' => $attribute, 'items' => $errors->{$errorBag ?? 'default'}->any() ? old($attribute, []) : collect($row->tags)->filter(function ($value) use ($items) { return $items->containsStrict('name', $value); })])

        @if (! $loop->last) <hr> @endif
    @endforeach

    <hr>

    <div class="row">
        <div class="form-group col-md-6">
            @set ($attribute, 'created_at')
            <label for="{{ $attribute }}">@lang ('Created At')</label>
            <div>{{ is_null($row->{$attribute}) ? null : now()->parse($row->{$attribute})->setTimezone(config('app.timezone'))->format('Y/m/d H:i') }}</div>
        </div>
        <div class="form-group col-md-6">
            @set ($attribute, 'updated_at')
            <label for="{{ $attribute }}">@lang ('Updated At')</label>
            <div>{{ is_null($row->{$attribute}) ? null : now()->parse($row->{$attribute})->setTimezone(config('app.timezone'))->format('Y/m/d H:i') }}</div>
        </div>
    </div>
@endif
