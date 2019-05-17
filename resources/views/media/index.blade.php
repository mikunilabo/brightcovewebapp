@extends ('layouts.app')

@section ('title', __('Media list'))

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb', ['lists' => [__('Media list') => route('media.index')]]) @endcomponent

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i>@lang ('Media list')

                                @can ('authorize', 'media-create')
                                    <a class="btn btn-primary btn-sm float-right" href="{{ route('media.upload') }}">
                                        <i class="nav-icon icon-cloud-upload"></i> @lang ('Media Upload')
                                    </a>
                                @endcan
                            </div>
                            <div class="card-body">
                                @component ('components.messages.alerts') @endcomponent

                                <table class="table table-responsive-sm table-striped table-hover" id="media-table">
                                    <colgroup>
                                        <col style="width: 10%;">
                                        <col style="width: 52%;">
                                        <col style="width: 8%;">
                                        <col style="width: 15%;">
                                        <col style="width: 15%;">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="text-nowrap">@lang ('ID')</th>
                                            <th class="text-nowrap">@lang ('Title')</th>
                                            <th class="text-nowrap">@lang ('Status')</th>
                                            <th class="text-nowrap">@lang ('Created At')</th>
                                            <th class="text-nowrap">@lang ('Updated At')</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody" class="d-none">
                                        @foreach ($rows as $row)
                                            <tr id="{{ $row->id }}">
                                                <td><code>{{ $row->id }}</code></td>
                                                <td>
                                                    <a href="{{ route('media.detail', $row->id) }}">{{ str_limit($row->name, 100, '...') }}</a>
                                                </td>
                                                <td>
                                                    @component ('components.labels.videos.state', ['state' => $row->state]) @endcomponent
                                                </td>
                                                <td>
                                                    @set ($attribute, 'created_at')
                                                    {{ is_null($row->{$attribute}) ? null : now()->parse($row->{$attribute})->setTimezone(config('app.timezone')) }}
                                                </td>
                                                <td>
                                                    @set ($attribute, 'updated_at')
                                                    {{ is_null($row->{$attribute}) ? null : now()->parse($row->{$attribute})->setTimezone(config('app.timezone')) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                @can ('authorize', ['media-delete', 'media-update'])
                                    <a href="#" class="btn btn-secondary btn-sm float-left dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        @lang ('Batch operation')
                                    </a>
                                @endcan

                                <div class="dropdown-menu">
                                    @can ('authorize', 'media-update')
                                        <a href="#" id="activate-btn" class="dropdown-item text-success disabled" onclick="event.preventDefault();">
                                            <i class="icons icon-share text-success"></i>@lang ('Activate')
                                        </a>
                                    @endcan

                                    @can ('authorize', 'media-update')
                                        <a href="#" id="deactivate-btn" class="dropdown-item disabled" onclick="event.preventDefault();">
                                            <i class="icons icon-ban"></i>@lang ('Deactivate')
                                        </a>
                                    @endcan

                                    <a href="#" id="select-all-btn" class="dropdown-item" onclick="event.preventDefault();">
                                        <i class="icons icon-check"></i>@lang ('Select all')
                                    </a>

                                    <a href="#" id="deselect-all-btn" class="dropdown-item disabled" onclick="event.preventDefault();">
                                        <i class="icons icon-close"></i>@lang ('Deselect all')
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    @can ('authorize', 'media-delete')
                                        <a href="#" id="delete-btn" class="dropdown-item text-danger disabled" onclick="event.preventDefault();">
                                            <i class="icons icon-trash text-danger"></i>@lang ('Delete')
                                        </a>
                                    @endcan
                                </div>

                                @can ('authorize', 'media-create')
                                    <a href="{{ route('media.upload') }}" class="btn btn-primary btn-sm float-right">
                                        <i class="nav-icon icon-cloud-upload"></i> @lang ('Media Upload')
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

            var activateBtn = document.getElementById('activate-btn');
            var deactivateBtn = document.getElementById('deactivate-btn');
            var selectallBtn = document.getElementById('select-all-btn');
            var deselectallBtn = document.getElementById('deselect-all-btn');
            var deleteBtn = document.getElementById('delete-btn');

            var table = $('#media-table').DataTable({
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
                    [3, 'desc'],
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
                    activateBtn.classList.remove('disabled');
                    deactivateBtn.classList.remove('disabled');
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
                        activateBtn.classList.add('disabled');
                        deactivateBtn.classList.add('disabled');
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

            activateBtn.addEventListener('click', function () {
                if (! confirm('@lang ('Are you sure you want to :action the selected :name?', ['name' => __('Media'), 'action' => __('Activate')])')) {
                    return false;
                }

                window.Common.overlay();
                var ids = table.rows('.selected').ids();

                window.axios.post("{{ route('webapi.media.activates') }}", {
                    ids: ids.toArray()
                })
                .then(response => {
                    // console.log(response.data);
                    window.location.reload();
                }).catch(error => {
                    window.Common.overlayOut();
                    console.log(error);
                });
            });

            deactivateBtn.addEventListener('click', function () {
                if (! confirm('@lang ('Are you sure you want to :action the selected :name?', ['name' => __('Media'), 'action' => __('Deactivate')])')) {
                    return false;
                }

                alert("@lang ('Not implemented')");
            });

            deleteBtn.addEventListener('click', function () {
                if (! confirm('@lang ('Are you sure you want to :action the selected :name?', ['name' => __('Media'), 'action' => __('Delete')])')) {
                    return false;
                }

                window.Common.overlay();
                var ids = table.rows('.selected').ids();

                window.axios.post("{{ route('webapi.media.deletes') }}", {
                    ids: ids.toArray()
                })
                .then(response => {
                    // console.log(response.data);
                    window.location.reload();
                }).catch(error => {
                    window.Common.overlayOut();
                    console.log(error);
                });
            });
        });
    </script>
@endsection
