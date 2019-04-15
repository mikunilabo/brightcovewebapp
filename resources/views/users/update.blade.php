@extends ('layouts.app')

@section ('title', __('Account detail'))

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb', ['lists' => [__('Account detail') => route('accounts.index')]]) @endcomponent

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('accounts.update', $row->id) }}" method="POST">
                                {{ csrf_field() }}

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i>@lang ('Account detail')
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        @component ('components.messages.alerts') @endcomponent

                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                @set ($attribute, 'name')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.users.%s', $attribute))</label>
                                                <input name="{{ $attribute }}" type="text" id="{{ $attribute }}" value="{{ old($attribute, optional($row)->{$attribute}) }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang ('Name')" required autofocus />
                                                @include ('components.messages.invalid', ['name' => $attribute])
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                @set ($attribute, 'email')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.users.%s', $attribute))</label>
                                                <input name="{{ $attribute }}" type="email" value="{{ old($attribute, optional($row)->{$attribute}) }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang ('E-Mail')" required disabled />
                                                @include ('components.messages.invalid', ['name' => $attribute])
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                @set ($attribute, 'role_id')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.users.%s', $attribute))</label>
                                                <select name="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" required disabled>
                                                    {{-- TODO from master table --}}
                                                    @foreach ([1 => 'Admin', 2 => 'User'] as $key => $value)
                                                        <option value="{{ $key }}" {{ (int)($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : optional($row)->{$attribute} ?? 2) === (int)$key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                @include ('components.messages.invalid', ['name' => $attribute])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    @component ('components.buttons.back') @endcomponent

                                    @can ('update', $row)
                                        <button type="submit" class="btn btn-primary">
                                            <i class="icons icon-check"></i> @lang ('Update')
                                        </button>
                                    @endcan

                                    @can ('delete', $row)
                                        <a class="btn btn-danger btn-sm float-right" href="#" onclick="event.preventDefault(); if (confirm('@lang("test?")')) console.log('entered.'); return false;">
                                            <i class="icons icon-trash"></i> @lang ('Delete account')
                                        </a>
                                    @endcan
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
@endsection
