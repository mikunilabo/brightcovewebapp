<aside class="aside-menu">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#information" role="tab">
                <i class="icon-info"></i>
            </a>
        </li>

        @if (false)
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings" role="tab">
                    <i class="icon-settings"></i>
                </a>
            </li>
        @endif
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
                    <small class="text-muted">{{ optional(Auth::user()->loginHistories()->latest()->skip(1)->limit(1)->first())->created_at }}</small>
                </div>
            </div>
        </div>

@if (false)
        <div class="tab-pane p-3" id="settings" role="tabpanel">
            <h6>Settings</h6>
            <div class="aside-options">
                <div class="clearfix mt-4">
                    <small>
                        <b>Option 1</b>
                    </small>
                    <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                        <input class="switch-input" type="checkbox" checked="">
                        <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                    </label>
                </div>
                <div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
            </div>
            <div class="aside-options">
                <div class="clearfix mt-3">
                    <small>
                        <b>Option 2</b>
                    </small>
                    <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                        <input class="switch-input" type="checkbox">
                        <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                    </label>
                </div>
                <div>
                    <small class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt...</small>
                </div>
            </div>
            <div class="aside-options">
                <div class="clearfix mt-3">
                    <small>
                        <b>Option 3</b>
                    </small>
                    <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                        <input class="switch-input" type="checkbox">
                        <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                    </label>
                </div>
            </div>
            <div class="aside-options">
                <div class="clearfix mt-3">
                    <small>
                        <b>Option 4</b>
                    </small>
                    <label class="switch switch-label switch-pill switch-success switch-sm float-right">
                        <input class="switch-input" type="checkbox" checked="">
                        <span class="switch-slider" data-checked="On" data-unchecked="Off"></span>
                    </label>
                </div>
            </div>
            <hr>
            <h6>System Utilization</h6>
            <div class="text-uppercase mb-1 mt-4">
                <small>
                    <b>CPU Usage</b>
                </small>
            </div>
            <div class="progress progress-xs">
                <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted">348 Processes. 1/4 Cores.</small>
            <div class="text-uppercase mb-1 mt-2">
                <small>
                    <b>Memory Usage</b>
                </small>
            </div>
            <div class="progress progress-xs">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted">11444GB/16384MB</small>
            <div class="text-uppercase mb-1 mt-2">
                <small>
                    <b>SSD 1 Usage</b>
                </small>
            </div>
            <div class="progress progress-xs">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted">243GB/256GB</small>
            <div class="text-uppercase mb-1 mt-2">
                <small>
                    <b>SSD 2 Usage</b>
                </small>
            </div>
            <div class="progress progress-xs">
                <div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted">25GB/256GB</small>
        </div>
    </div>
@endif
</aside>
