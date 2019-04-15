@extends ('layouts.app')

@section ('title', __('Dashboard'))

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb') @endcomponent

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">@lang ('Dashboard')
                                <div class="card-header-actions">
                                    <a class="card-header-action btn-setting" href="#">
                                        <i class="icon-settings"></i>
                                    </a>
                                    <a class="card-header-action btn-minimize" href="#" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true">
                                        <i class="icon-arrow-up"></i>
                                    </a>
                                    <a class="card-header-action btn-close" href="#">
                                        <i class="icon-close"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="collapse show" id="collapseExample">
                                <div class="card-body">
                                    @component ('components.messages.alerts') @endcomponent

                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip exea commodo consequat.
                                </div>
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

    <script type="text/javascript" src="{{ asset(mix('js/vendor/coreui/main.js')) }}" defer></script>
@endsection
