@extends ('layouts.app')

@section ('title', __('Media Upload'))

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb', ['lists' => [__('Media Upload') => route('media.upload')]]) @endcomponent

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form id="upload-form" action="{{ route('media.upload') }}" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                                {{ csrf_field() }}

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i>@lang ('Media Upload')
                                </div>
                                <div class="card-body">
                                    @component ('components.messages.alerts') @endcomponent

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'video_file')
                                            <label for="{{ $attribute }}">@lang ('Video File') <code>*</code></label>

                                            @component ('components.popovers.informations', ['content' => '20MB']) @endcomponent

                                            <div>
                                                <input type="file" id="{{ $attribute }}" class="{{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" required />
                                                @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                            </div>
                                        </div>
                                    </div>

                                    @if (false)
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'name')
                                            <label for="{{ $attribute }}">@lang ('Title') <code>*</code></label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="1" placeholder="" autocomplete="off" required>{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'description')
                                            <label for="{{ $attribute }}">@lang ('Description')</label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="4" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'long_description')
                                            <label for="{{ $attribute }}">@lang ('Keywords')</label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="3" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'rightholder')
                                            <label for="{{ $attribute }}">@lang ('Rightholder')</label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="1" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'tournament')
                                            <label for="{{ $attribute }}">@lang ('Tournament')</label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="1" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>

                                    @foreach (['leagues' => Auth::user()->leagues, 'universities' => Auth::user()->universities, 'sports' => Auth::user()->sports] as $attribute => $items)
                                        @include ('components.typeahead.lists', ['attribute' => $attribute, 'items' => $errors->{$errorBag ?? 'default'}->any() ? old($attribute, []) : $items->pluck('name')->all()])
                                        <hr>
                                    @endforeach
                                    @endif
                                </div>
                                <div class="card-footer text-center">
                                    @component ('components.buttons.back') @endcomponent

                                    <button type="submit" class="btn btn-primary" id="submit-btn">
                                        <i class="icons icon-check"></i> @lang ('Upload')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section ('scripts')
    @parent

<script language="javascript" type="text/javascript" src="/vendor/evaporate/evaporate.js"></script>
<script type="text/javascript">
    var URL_WEBAPI_MEDIA_CREATE = "{{ route('webapi.media.create') }}";
    document.getElementById('submit-btn').addEventListener('click', function () {
        window.Uploader.process();
    });
</script>
@endsection
