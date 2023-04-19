<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/dev-logo.png') }}" class="menu-logo" width="50" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text text-secondary fw-bold" style="font-size: 18px;">Water Monitoring</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left text-secondary"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        {{-- Divider --}}
        <li class="menu-label metis-logo--hide">PLANT NAME</li>
        <li class="metis-logo--hide">
            <img style="width:200px;" class="img-fluid metis-logo--hide" src='{{ asset('assets/images/logo_grootech2.png') }}' alt="">
        </li>
        <li class="disable metis-logo--hide">
            <a href="javascrip:void(0)" class="py-0">
                <div class="parent-icon"><i class="fa fa-fw fa-industry"></i>
                </div>
                <div class="menu-title">Grootech</div>
            </a>
            <a href="javascrip:void(0)" class="py-0">
                <div class="parent-icon"><i class="fa fa-fw fa-map-marker"></i>
                </div>
                <div class="menu-title">Bekasi, Jawa Barat, Indonesia</div>
            </a>
        </li>
        {{-- Divider --}}
        <div class="metis-logo--hide"><hr class="sidebar-divider"></div>
        <li class="menu-label">NAVIGATION</li>
        <li>
            <a href="#">
                <div class="parent-icon"><i class="lni lni-home"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="/cash-request">
                <div class="parent-icon"><i class="bx bx-cloud-download"></i>
                </div>
                <div class="menu-title">Cash Request</div>
            </a>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
              <div class="parent-icon"><i class="fadeIn animated bx bx-unite"></i>
              </div>
              <div class="menu-title">Finance</div>
            </a>
            <ul>
                <li> <a href="/chart-of-accounts"><i class="fadeIn animated bx bx-window-alt"></i>Chart Of Accounts </a></li>
                <li> <a href="/journal"><i class="lni lni-book"></i>Journal</a></li>
            </ul>
          </li>
        {{-- <li>
            <a href="#">
                <div class="parent-icon"><i data-feather="trending-up"></i>
                </div>
                <div class="menu-title">Trending Report</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="parent-icon"><i class="lni lni-alarm-clock"></i>
                </div>
                <div class="menu-title">Alarm</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="parent-icon"><i class="bx bx-cloud-download"></i>
                </div>
                <div class="menu-title">API Logs</div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="parent-icon"><i data-feather="wifi"></i>
                </div>
                <div class="menu-title">Connection Logs</div>
            </a>
        </li> --}}
        <li class="{{ request()->segment(1) == 'settings' ? 'mm-active' : '' }}">
            <a href="{{ route('settings') }}">
                <div class="parent-icon"><i data-feather="settings"></i>
                </div>
                <div class="menu-title">Setting</div>
            </a>
        </li>
        <li>
            <a href="#" onclick="logout()">
                <div class="parent-icon"><i data-feather="log-out"></i>
                </div>
                <div class="menu-title">Log Out</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</aside>