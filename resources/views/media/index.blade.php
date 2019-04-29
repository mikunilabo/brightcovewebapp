@extends ('layouts.app')

@section ('title', __('Media list'))

@section ('Styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
@endsection

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
                                            <th>
                                                <input type="checkbox" />
                                            </th>
                                            <th>@lang ('attributes.media.id')</th>
                                            <th>@lang ('attributes.media.name')</th>
                                            <th>@lang ('attributes.media.state')</th>
                                            <th>@lang ('Created At')</th>
                                            <th>@lang ('Updated At')</th>
                                            <th><i class="nav-icon icon-options"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rows as $row)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" />
                                                </td>
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
                                                <td>
                                                    <div class="nav navbar-nav">
                                                        <div class="nav-item dropdown">
                                                            <a class="nav-link p-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                                                <i class="nav-icon icon-options"></i>
                                                            </a>

                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                @can ('select', $row)
                                                                    <a class="dropdown-item" href="{{ route('media.detail', $row->id) }}">
                                                                        <i class="icons icon-note"></i>@lang ('Detail')
                                                                    </a>
                                                                @endcan

                                                                @can ('delete', $row)
                                                                    <a class="dropdown-item text-danger" href="{{ route('media.delete', $row->id) }}" onclick="event.preventDefault(); if (confirm('@lang ('Are you sure you want to delete this :name?', ['name' => __('Media')])')) { window.Common.submitForm('{{ route('media.delete', $row->id) }}'); } return false;">
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

                                @can ('authorize', 'media-create')
                                    <a class="btn btn-primary btn-sm float-right" href="{{ route('media.upload') }}">
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


    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.extend( $.fn.dataTable.defaults, {
                language: {
                    url: "{{ asset('vendor/DataTables/ja.json') }}"
                }
            });
            $('#media-table').DataTable({
                columnDefs: [
                    {
                        targets: [0, 6],
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
