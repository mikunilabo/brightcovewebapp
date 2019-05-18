<aside class="aside-menu">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#information" role="tab">
                <i class="icon-info"></i>
            </a>
        </li>
    </ul>

    <!-- Tab panes-->
    <div class="tab-content">
        <div class="tab-pane active p-3" id="information" role="tabpanel">
            <h6>@lang ('Information')</h6>
            <div class="aside-options">
                <div class="clearfix mt-3">
                    <small>
                        <b>@lang ('Previous login')</b>
                    </small>
                </div>
                <div>
                    <small class="text-muted">
                        {{ optional(Auth::user()->loginHistories()->latest()->skip(1)->limit(1)->first())->created_at }}
                    </small>
                </div>
                <hr>
                <div class="clearfix mt-3">
                    <img src="{{ config('resources.images.logo_full') }}" class="navbar-brand-full" width="145" height="auto" alt="{{ config('app.name') }}">
                </div>
                <div class="clearfix mt-3">
                    <small>
                        <b>@lang ('Version')</b>
                    </small>
                </div>
                <div>
                    <small class="text-muted">
                        {{ config('app.version') }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</aside>
