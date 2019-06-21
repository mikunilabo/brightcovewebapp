@extends ('layouts.app')

@section ('title', __('Account detail'))

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb', ['lists' => [__('Account detail') => route('accounts.detail', $row->id)]]) @endcomponent

        <div class="container-fluid animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form action="{{ route('accounts.detail', $row->id) }}" method="POST" autocomplete="off" onsubmit="window.Common.overlay();">
                            {{ csrf_field() }}

                            <div class="card-header">
                                <i class="icons icon-note"></i>@lang ('Account detail')
                            </div>
                            <div class="card-body">
                                @component ('components.messages.alerts') @endcomponent

                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        @set ($attribute, 'id')
                                        <label for="{{ $attribute }}">@lang ('ID')</label>
                                        <div><code>{{ $row->{$attribute} }}</code></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        @set ($attribute, 'name')
                                        <label for="{{ $attribute }}">@lang ('Name') <code>*</code></label>
                                        <input name="{{ $attribute }}" type="text" id="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="255" placeholder="" required autofocus />
                                        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                    </div>
                                    <div class="form-group col-sm-6">
                                        @set ($attribute, 'company')
                                        <label for="{{ $attribute }}">@lang ('Company')</label>
                                        <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="255" placeholder="" />
                                        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        @set ($attribute, 'email')
                                        <label for="{{ $attribute }}">@lang ('E-Mail')</label>
                                        @component ('components.popovers.informations', ['content' => __('You can not change the :name.', ['name' => __('E-Mail')])]) @endcomponent

                                        <input name="{{ $attribute }}" type="email" value="{{ $row->{$attribute} }}" class="form-control" maxlength="255" placeholder="" disabled />
                                    </div>
                                    <div class="form-group col-sm-6">
                                        @set ($attribute, 'role_id')
                                        <label for="{{ $attribute }}">@lang ('Role')</label>
                                        @component ('components.popovers.informations', ['content' => __('You can not change the :name.', ['name' => __('Role')])]) @endcomponent

                                        <select name="{{ $attribute }}" class="form-control" disabled>
                                            @foreach ($vc_roles->pluck('name', 'id') as $key => $value)
                                                <option value="{{ $key }}" {{ $row->{$attribute} === (int)$key ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        @set ($attribute, 'leagues')
                                        <label for="{{ $attribute }}">@lang ('Leagues')</label>

                                        @component ('components.popovers.informations', ['content' => sprintf('%s<br>%s',
                                            __('It will be automatically selected when uploading.'),
                                            Auth::user()->can('authorize', 'user-create') ? __('If it is not in the list, it will be newly registered.') : '')
                                        ]) @endcomponent

                                        <div class="input-group">
                                            <input name="{{ $attribute }}" type="text" id="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute}->pluck('name')->first() }}" class="form-control {{ sprintf('ta-%s', $attribute) }} {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang ('Please select')" />
                                        </div>
                                        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                    </div>
                                    <div class="form-group col-md-6">
                                        @set ($attribute, 'universities')
                                        <label for="{{ $attribute }}">@lang ('Universities')</label>

                                        @component ('components.popovers.informations', ['content' => sprintf('%s<br>%s',
                                            __('It will be automatically selected when uploading.'),
                                            Auth::user()->can('authorize', 'user-create') ? __('If it is not in the list, it will be newly registered.') : '')
                                        ]) @endcomponent

                                        <div class="input-group">
                                            <input name="{{ $attribute }}" type="text" id="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute}->pluck('name')->first() }}" class="form-control {{ sprintf('ta-%s', $attribute) }} {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang ('Please select')" />
                                        </div>
                                        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                    </div>
                                </div>

                                @set ($attribute, 'sports')
                                @include ('components.typeahead.lists', ['attribute' => $attribute, 'items' => $errors->{$errorBag ?? 'default'}->any() ? old($attribute, []) : $row->{$attribute}->pluck('name')])

                                <hr>

                                <div class="row">
                                    <div class="form-group col-sm-3">
                                        <label>@lang ('Created At')</label>
                                        <div>{{ $row->created_at->format('Y/m/d H:i') }}</div>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label>@lang ('Updated At')</label>
                                        <div>{{ $row->updated_at->format('Y/m/d H:i') }}</div>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label>@lang ('Last login')</label>
                                        <div>{{ is_null($history = $row->loginHistories->sortByDesc('created_at')->first()) ? '-' : $history->created_at->format('Y/m/d H:i') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                @component ('components.buttons.back') @endcomponent

                                @can ('authorize', 'user-create')
                                    <button class="btn btn-sm btn-outline-warning ml-2 float-left" type="button" data-toggle="modal" data-target="#leagues-modal">
                                        <i class="icons icon-tag">@lang ('Leagues')</i>
                                    </button>

                                    <button class="btn btn-sm btn-outline-warning ml-2 float-left" type="button" data-toggle="modal" data-target="#universities-modal">
                                        <i class="icons icon-tag">@lang ('Universities')</i>
                                    </button>

                                    <button class="btn btn-sm btn-outline-warning ml-2 float-left" type="button" data-toggle="modal" data-target="#sports-modal">
                                        <i class="icons icon-tag">@lang ('Sports')</i>
                                    </button>
                                @endcan

                                @can ('update', $row)
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="icons icon-check"></i> @lang ('Update')
                                    </button>
                                @endcan

                                @can ('delete', $row)
                                    <a class="btn btn-outline-danger btn-sm float-right" href="#" onclick="event.preventDefault(); if (confirm('@lang ('Are you sure you want to delete this :name?', ['name' => __('Account')])')) { window.Common.submitForm('{{ route('accounts.delete', $row->id) }}'); } return false;">
                                        <i class="icons icon-trash"></i> @lang ('Delete account')
                                    </a>
                                @endcan
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @can ('authorize', 'user-create')
        @component ('components.modals.masters', ['name' => 'leagues']) @endcomponent
        @component ('components.modals.masters', ['name' => 'universities']) @endcomponent
        @component ('components.modals.masters', ['name' => 'sports']) @endcomponent
    @endcan
@endsection

@section ('scripts')
    @parent

    <script type="text/javascript">
      ta('.ta-leagues', 'leagues');
      ta('.ta-universities', 'universities');
      ta('.ta-sports', 'sports');

      @can ('authorize', 'user-create')
        window.Common.listMasters('leagues');
        window.Common.listMasters('universities');
        window.Common.listMasters('sports');
      @endcan

      /**
       * @param string tag
       * @param string name
       * @return void
       */
      function ta(tag, name) {
        var data = getMasters(name);

        $(tag).typeahead({
          highlight: true,
          hint: false,
          minLength: 0
        },
        {
          name: 'states',
          limit: 100,
          source: window.Common.substringMatcher(data)
        });
      }

      /**
       * @param string name
       * @return json
       * @throw Error
       */
      function getMasters(name) {
        switch (true) {
          case name === 'leagues':
            return @json ($vc_leagues->pluck('name'));
          case name === 'sports':
            return @json ($vc_sports->pluck('name'));
          case name === 'universities':
            return @json ($vc_universities->pluck('name'));
          default:
            throw new Error(`The master name [${name}] is invalid.`);
        }
      }
    </script>
@endsection
