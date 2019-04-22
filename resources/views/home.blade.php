@extends ('layouts.app')

@section ('title', __('Dashboard'))

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb') @endcomponent

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section ('scripts')
    @parent
@endsection
