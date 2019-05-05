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
                                    <thead>
                                        <tr>
                                            <th>@lang ('ID')</th>
                                            <th>@lang ('Title')</th>
                                            <th>@lang ('Status')</th>
                                            <th>@lang ('Created At')</th>
                                            <th>@lang ('Updated At')</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody" class="d-none">
                                        @foreach ($rows as $row)
                                            <tr id="{{ $row->id }}">
                                                <td><code>{{ $row->id }}</code></td>
                                                <td>
                                                    <a href="{{ route('media.detail', $row->id) }}">{{ $row->name }}</a>
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

                                @can ('authorize', ['media-delete', 'media-update'])
                                    <div class="dropdown-menu" disabled>
                                        @can ('authorize', 'media-update')
                                            <a href="#" id="activate-btn" class="dropdown-item text-success disabled" onclick="event.preventDefault(); if (confirm('@lang ('Are you sure you want to :action the selected :name?', ['name' => __('Media'), 'action' => __('Activate')])')) {  } return false;">
                                                <i class="icons icon-share text-success"></i>@lang ('Activate')
                                            </a>
                                        @endcan

                                        @can ('authorize', 'media-update')
                                            <a href="#" id="deactivate-btn" class="dropdown-item disabled" onclick="event.preventDefault(); if (confirm('@lang ('Are you sure you want to :action the selected :name?', ['name' => __('Media'), 'action' => __('Deactivate')])')) {  } return false;">
                                                <i class="icons icon-ban"></i>@lang ('Deactivate')
                                            </a>
                                        @endcan

                                        <div class="dropdown-divider"></div>

                                        @can ('authorize', 'media-delete')
                                            <a href="#" id="delete-btn" class="dropdown-item text-danger disabled" onclick="event.preventDefault(); if (confirm('@lang ('Are you sure you want to :action the selected :name?', ['name' => __('Media'), 'action' => __('Delete')])')) {  } return false;">
                                                <i class="icons icon-trash text-danger"></i>@lang ('Delete')
                                            </a>
                                        @endcan
                                    </div>
                                @endcan

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

            $('#delete-btn').click(function () {
                var ids = table.rows('.selected').ids();
                console.log(ids.toArray());
            });

            table
            .on('select', function (e, dt, type, indexes) {
                if (type === 'row' && table.rows('.selected').data().length > 0) {
                    document.getElementById('activate-btn').classList.remove('disabled');
                    document.getElementById('deactivate-btn').classList.remove('disabled');
                    document.getElementById('delete-btn').classList.remove('disabled');
                }
            })
            .on('deselect', function (e, dt, type, indexes) {
                if (type === 'row' && table.rows('.selected').data().length === 0) {
                    document.getElementById('activate-btn').classList.add('disabled');
                    document.getElementById('deactivate-btn').classList.add('disabled');
                    document.getElementById('delete-btn').classList.add('disabled');
                }
            });
        });
    </script>
@endsection
