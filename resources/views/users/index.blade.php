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
                                    <colgroup>
                                        <col style="width: 15%;">
                                        <col style="width: 20%;">
                                        <col style="width: 15%;">
                                        <col style="width: 10%;">
                                        <col style="width: 20%;">
                                        <col style="width: 8%;">
                                        <col style="width: 12%;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">@lang ('Name')</th>
                                            <th class="text-nowrap">@lang ('ID')</th>
                                            <th class="text-nowrap">@lang ('Company')</th>
                                            <th class="text-nowrap">@lang ('Role')</th>
                                            <th class="text-nowrap">@lang ('E-Mail')</th>
                                            <th class="text-nowrap">@lang ('Last login')</th>
                                            <th class="text-nowrap">@lang ('Created At')</th>
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
                                                <td class="text-center">
                                                    {{ is_null($createdAt = optional($row->loginHistories->first())->created_at) ? '-' : $createdAt->fuzzy() }}
                                                </td>
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
                pagingType: 'full_numbers',
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
