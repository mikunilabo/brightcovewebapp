  <div class="sidebar">
    <nav class="sidebar-nav">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">
            <i class="nav-icon icon-speedometer"></i> Dashboard
            <span class="badge badge-primary">NEW</span>
          </a>
        </li>
        <li class="nav-title">Theme</li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('theme.colors') }}">
            <i class="nav-icon icon-drop"></i> Colors</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('theme.typography') }}">
            <i class="nav-icon icon-pencil"></i> Typography</a>
        </li>
        <li class="nav-title">Components</li>
        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon icon-puzzle"></i> Base</a>
          <ul class="nav-dropdown-items">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.breadcrumb') }}">
                <i class="nav-icon icon-puzzle"></i> Breadcrumb</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.cards') }}">
                <i class="nav-icon icon-puzzle"></i> Cards</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.carousel') }}">
                <i class="nav-icon icon-puzzle"></i> Carousel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.collapse') }}">
                <i class="nav-icon icon-puzzle"></i> Collapse</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.forms') }}">
                <i class="nav-icon icon-puzzle"></i> Forms</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.jumbotron') }}">
                <i class="nav-icon icon-puzzle"></i> Jumbotron</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.list_group') }}">
                <i class="nav-icon icon-puzzle"></i> List group</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.navs') }}">
                <i class="nav-icon icon-puzzle"></i> Navs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.pagination') }}">
                <i class="nav-icon icon-puzzle"></i> Pagination</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.popovers') }}">
                <i class="nav-icon icon-puzzle"></i> Popovers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.progress') }}">
                <i class="nav-icon icon-puzzle"></i> Progress</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.scrollspy') }}">
                <i class="nav-icon icon-puzzle"></i> Scrollspy</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.switches') }}">
                <i class="nav-icon icon-puzzle"></i> Switches</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.tables') }}">
                <i class="nav-icon icon-puzzle"></i> Tables</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.tabs') }}">
                <i class="nav-icon icon-puzzle"></i> Tabs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.base.tooltips') }}">
                <i class="nav-icon icon-puzzle"></i> Tooltips</a>
            </li>
          </ul>
        </li>
        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon icon-cursor"></i> Buttons</a>
          <ul class="nav-dropdown-items">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.buttons.buttons') }}">
                <i class="nav-icon icon-cursor"></i> Buttons</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.buttons.button_group') }}">
                <i class="nav-icon icon-cursor"></i> Buttons Group</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.buttons.dropdowns') }}">
                <i class="nav-icon icon-cursor"></i> Dropdowns</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.buttons.brand_buttons') }}">
                <i class="nav-icon icon-cursor"></i> Brand Buttons</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('components.charts') }}">
            <i class="nav-icon icon-pie-chart"></i> Charts</a>
        </li>
        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon icon-star"></i> Icons</a>
          <ul class="nav-dropdown-items">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.icons.coreui_icons') }}">
                <i class="nav-icon icon-star"></i> CoreUI Icons
                <span class="badge badge-success">NEW</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.icons.flags') }}">
                <i class="nav-icon icon-star"></i> Flags</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.icons.font_awesome') }}">
                <i class="nav-icon icon-star"></i> Font Awesome
                <span class="badge badge-secondary">4.7</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.icons.simple_line_icons') }}">
                <i class="nav-icon icon-star"></i> Simple Line Icons</a>
            </li>
          </ul>
        </li>
        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon icon-bell"></i> Notifications</a>
          <ul class="nav-dropdown-items">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.notifications.alerts') }}">
                <i class="nav-icon icon-bell"></i> Alerts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.notifications.badges') }}">
                <i class="nav-icon icon-bell"></i> Badges</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('components.notifications.modals') }}">
                <i class="nav-icon icon-bell"></i> Modals</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('components.widgets') }}">
            <i class="nav-icon icon-calculator"></i> Widgets
            <span class="badge badge-primary">NEW</span>
          </a>
        </li>
        <li class="divider"></li>
        <li class="nav-title">Extras</li>
        <li class="nav-item nav-dropdown">
          <a class="nav-link nav-dropdown-toggle" href="#">
            <i class="nav-icon icon-star"></i> Pages</a>
          <ul class="nav-dropdown-items">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('extras.pages.login') }}" target="_top">
                <i class="nav-icon icon-star"></i> Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('extras.pages.register') }}" target="_top">
                <i class="nav-icon icon-star"></i> Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('extras.pages.password.request') }}" target="_top">
                <i class="nav-icon icon-star"></i> Password Request</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('extras.pages.password.reset') }}" target="_top">
                <i class="nav-icon icon-star"></i> Password Reset</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('extras.pages.errors.404') }}" target="_top">
                <i class="nav-icon icon-star"></i> Error 404</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('extras.pages.errors.500') }}" target="_top">
                <i class="nav-icon icon-star"></i> Error 500</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('extras.pages.blank') }}" target="_top">
                <i class="nav-icon icon-star"></i> Blank</a>
            </li>
          </ul>
        </li>
{{--
        <li class="nav-item mt-auto">
          <a class="nav-link nav-link-success" href="https://coreui.io" target="_top">
            <i class="nav-icon icon-cloud-download"></i> Download CoreUI</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-danger" href="https://coreui.io/pro/" target="_top">
            <i class="nav-icon icon-layers"></i> Try CoreUI
            <strong>PRO</strong>
          </a>
        </li>
--}}
      </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
  </div>
