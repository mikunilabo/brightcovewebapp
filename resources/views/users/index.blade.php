@extends ('layouts.app')

@section ('title', __('Accounts list'))

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb', ['lists' => [__('Accounts list') => route('accounts.index')]]) @endcomponent

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i>@lang ('Accounts list')

                                @can ('authorize', 'user-create')
                                    <a class="btn btn-primary btn-sm float-right" href="#">
                                        <i class="nav-icon icon-user-follow"></i> @lang ('Create account')
                                    </a>
                                @endcan
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive-sm table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" />
                                            </th>
                                            <th>@lang ('attributes.users.name')</th>
                                            <th>@lang ('attributes.users.email')</th>
                                            <th>@lang ('attributes.users.role_id')</th>
                                            <th>@lang ('Last login')</th>
                                            <th>@lang ('Created At')</th>
                                            <th><i class="nav-icon icon-options"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $row)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" />
                                                </td>
                                                <td>{{ $row->name }}</td>
                                                <td><code>{{ $row->email }}</code></td>
                                                <td><span class="badge badge-{{ $row->role->slug === 'admin' ? 'dark' : 'light' }}">{{ $row->role->name }}</span></td>
                                                <td>{{ optional($row->loginHistories->first())->created_at }}</td>
                                                <td>{{ $row->created_at }}</td>
                                                <td class="p-0">
                                                    <ul class="nav mt-1">
                                                        <li class="nav-item dropdown">
                                                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                                <i class="nav-icon icon-options"></i>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                @can ('select', $row)
                                                                    <a class="dropdown-item" href="{{ route('accounts.update', $row->id) }}">
                                                                        <i class="icons icon-note"></i>@lang ('Detail')
                                                                    </a>
                                                                @endcan

                                                                @can ('delete', $row)
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); if (confirm('@lang("test?")')) console.log('entered.'); return false;">
                                                                        <i class="icons icon-trash text-danger"></i>@lang ('Delete')
                                                                    </a>
                                                                @endcan
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {!! $users->render() !!}
                            </div>
                            <div class="card-footer">
                                <a class="btn btn-secondary btn-sm float-left dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    @lang ('Batch operation')
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); if (confirm('@lang("test?")')) console.log('entered.'); return false;">
                                        <i class="icons icon-trash text-danger"></i>@lang ('Delete')
                                    </a>
                                </div>

                                @can ('authorize', 'user-create')
                                    <a class="btn btn-primary btn-sm float-right" href="#">
                                        <i class="nav-icon icon-user-follow"></i> @lang ('Create account')
                                    </a>
                                @endcan
                            </div>
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
