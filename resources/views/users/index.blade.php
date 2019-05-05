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
                                            <th>@lang ('Name')</th>
                                            <th>@lang ('ID')</th>
                                            <th>@lang ('Company')</th>
                                            <th>@lang ('Role')</th>
                                            <th>@lang ('E-Mail')</th>
                                            <th>@lang ('Last login')</th>
                                            <th>@lang ('Created At')</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody" class="d-none">
                                        @foreach ($rows as $row)
                                            <tr id="{{ $row->id }}">
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
                                                <td>{{ $row->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
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

    <script type="text/javascript">
        window.Common.overlay();

        $(document).ready(function () {
            $.extend($.fn.dataTable.defaults, {
                language: {
                    url: "{{ asset('vendor/DataTables/ja.json') }}"
                }
            });

            var table = $('#users-table').DataTable({
                columnDefs: [],
                displayLength: 20,
                'drawCallback': function () {
                    window.Common.overlayOut();
                    document.getElementById('tbody').classList.remove('d-none');
                },
                info: true,
                lengthChange: true,
                lengthMenu: [10, 20, 30, 50],
                order: [
                    [6, 'desc'],
                ],
                ordering: true,
                paging: true,
                scrollX: false,
                searching: true,
                select: {
                    style: 'multi',
                    selector: 'tr',
                    blurable: false,
                },
                stateSave: true,
                responsive: true,
            });
        });
    </script>
@endsection
