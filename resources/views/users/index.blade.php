@extends ('layouts.app')

@section ('title', __('Accounts list'))

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb', ['lists' => [__('Accounts list') => route('accounts.index')]]) @endcomponent

        <div class="container-fluid animated fadeIn">
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
                                        <th class="align-middle text-nowrap">@lang ('Name')</th>
                                        <th class="align-middle text-nowrap">@lang ('ID')</th>
                                        <th class="align-middle text-nowrap">@lang ('Company')</th>
                                        <th class="align-middle text-nowrap">@lang ('Role')</th>
                                        <th class="align-middle text-nowrap">@lang ('E-Mail')</th>
                                        <th class="align-middle text-nowrap">@lang ('Last login')</th>
                                        <th class="align-middle text-nowrap">@lang ('Created At')</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody" class="d-none">
                                    @foreach ($rows as $row)
                                        <tr id="{{ $row->id }}">
                                            <td class="align-middle">
                                                <a href="{{ route('accounts.detail', $row->id) }}">{{ str_limit($row->name, 25, '...') }}</a>
                                            </td>
                                            <td class="align-middle"><code>{{ $row->id }}</code></td>
                                            <td class="align-middle">{{ str_limit($row->company, 25, '...') }}</td>
                                            <td class="align-middle">
                                                <span class="badge badge-{{ $row->role->slug === 'admin' ? 'dark' : 'light' }}">{{ $row->role->name }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('accounts.detail', $row->id) }}">
                                                    <code>{{ str_limit($row->email, 30, '...') }}</code>
                                                </a>
                                            </td>
                                            <td class="align-middle">
                                                {{ is_null($history = $row->loginHistories->sortByDesc('created_at')->first()) ? '-' : $history->created_at->fuzzy() }}
                                            </td>
                                            <td class="align-middle">{{ $row->created_at->format('Y/m/d H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            @can ('authorize', 'user-delete')
                                <a href="#" class="btn btn-secondary btn-sm float-left dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    @lang ('Batch operation')
                                </a>
                            @endcan

                            <div class="dropdown-menu">
                                <a href="#" id="select-all-btn" class="dropdown-item" onclick="event.preventDefault();">
                                    <i class="icons icon-check"></i>@lang ('Select all')
                                </a>

                                <a href="#" id="deselect-all-btn" class="dropdown-item disabled" onclick="event.preventDefault();">
                                    <i class="icons icon-close"></i>@lang ('Deselect all')
                                </a>

                                @can ('authorize', 'user-delete')
                                    <div class="dropdown-divider"></div>

                                    <a href="#" id="delete-btn" class="dropdown-item text-danger disabled" onclick="event.preventDefault();">
                                        <i class="icons icon-trash text-danger"></i>@lang ('Delete')
                                    </a>
                                @endcan
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

            var selectallBtn = document.getElementById('select-all-btn');
            var deselectallBtn = document.getElementById('deselect-all-btn');
            var deleteBtn = document.getElementById('delete-btn');

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
            })
            .on('select', function (e, dt, type, indexes) {
                if (type === 'row' && table.rows('.selected').data().length > 0) {
                    deleteBtn.classList.remove('disabled');
                    deselectallBtn.classList.remove('disabled');

                    if (table.rows('.selected').data().length === table.rows().data().length) {
                        selectallBtn.classList.add('disabled');
                    	}
                }
            })
            .on('deselect', function (e, dt, type, indexes) {
                if (type === 'row' && table.rows('.selected').data().length < table.rows().data().length) {
                    selectallBtn.classList.remove('disabled');

                    if (table.rows('.selected').data().length === 0) {
                        deleteBtn.classList.add('disabled');
                        deselectallBtn.classList.add('disabled');
                    }
                }
            });

            selectallBtn.addEventListener('click', function () {
                table.rows().select();
            });

            deselectallBtn.addEventListener('click', function () {
                table.rows().deselect();
            });

            deleteBtn.addEventListener('click', function () {
                if (! confirm('@lang ('Are you sure you want to :action the selected :name?', ['name' => __('Account'), 'action' => __('Delete')])')) {
                    return false;
                }

                window.Common.overlay();
                var ids = table.rows('.selected').ids();

                window.axios.post("{{ route('webapi.accounts.deletes') }}", {
                    ids: ids.toArray()
                })
                .then(response => {
                    // console.log(response.data);
                    window.location.reload();
                }).catch(error => {
                    window.Common.overlayOut();
                    console.error(error);
                });
            });
        });
    </script>
@endsection
