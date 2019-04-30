@extends ('layouts.app')

@section ('title', __('Accounts list'))

@section ('Styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
@endsection

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
                                    <a class="btn btn-primary btn-sm float-right" href="{{ route('accounts.create') }}">
                                        <i class="nav-icon icon-user-follow"></i> @lang ('Create account')
                                    </a>
                                @endcan
                            </div>
                            <div class="card-body">
                                @component ('components.messages.alerts') @endcomponent

                                <table class="table table-responsive-sm table-striped table-hover" id="users-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" />
                                            </th>
                                            <th>@lang ('attributes.users.name')</th>
                                            <th>@lang ('attributes.users.id')</th>
                                            <th>@lang ('attributes.users.company')</th>
                                            <th>@lang ('attributes.users.role_id')</th>
                                            <th>@lang ('attributes.users.email')</th>
                                            <th>@lang ('Last login')</th>
                                            <th><i class="nav-icon icon-options"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rows as $row)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" />
                                                </td>
                                                <td>
                                                    <a href="{{ route('accounts.detail', $row->id) }}">{{ $row->name }}</a>
                                                </td>
                                                <td><code>{{ $row->id }}</code></td>
                                                <td>{{ $row->company }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $row->role->slug === 'admin' ? 'dark' : 'light' }}">{{ $row->role->name }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('accounts.detail', $row->id) }}">
                                                        <code>{{ $row->email }}</code>
                                                    </a>
                                                </td>
                                                <td>{{ is_null($createdAt = optional($row->loginHistories->first())->created_at) ? '-' : $createdAt->fuzzy() }}</td>
                                                <td>
                                                    <div class="nav navbar-nav">
                                                        <div class="nav-item dropdown">
                                                            <a class="nav-link p-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                                <i class="nav-icon icon-options"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                @can ('select', $row)
                                                                    <a class="dropdown-item" href="{{ route('accounts.detail', $row->id) }}">
                                                                        <i class="icons icon-note"></i>@lang ('Detail')
                                                                    </a>
                                                                @endcan

                                                                @can ('delete', $row)
                                                                    <a class="dropdown-item text-danger" href="{{ route('accounts.delete', $row->id) }}" onclick="event.preventDefault(); if (confirm('@lang ('Are you sure you want to delete this :name?', ['name' => __('Account')])')) { window.Common.submitForm('{{ route('accounts.delete', $row->id) }}'); } return false;">
                                                                        <i class="icons icon-trash text-danger"></i>@lang ('Delete')
                                                                    </a>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{--{!! $rows->render() !!}--}}
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
                                    <a class="btn btn-primary btn-sm float-right" href="{{ route('accounts.create') }}">
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


    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.extend( $.fn.dataTable.defaults, {
                language: {
                    url: "{{ asset('vendor/DataTables/ja.json') }}"
                }
            });
            $('#users-table').DataTable({
                columnDefs: [
                    {
                        targets: [0, 7],
                        orderable: false
                    }
                ],
                displayLength: 25,
                info: true,
                lengthChange: true,
                lengthMenu: [10, 25, 50, 100],
                order: [],
                ordering: true,
                paging: true,
                scrollX: false,
                searching: true,
                stateSave: true,
                responsive: true,
            });
        });
    </script>
} );
@endsection
