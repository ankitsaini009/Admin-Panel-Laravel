<div class="dlabnav">
    <div class="dlabnav-scroll">
        <div class="dropdown header-profile2 ">
            <a class="nav-link " href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                <div class="header-info2 d-flex align-items-center">
                    <img src="https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg" alt="" />
                    <div class="d-flex align-items-center sidebar-info">
                        <div>
                            <span class="font-w400 d-block">Admin </span>
                            <!-- <small class="text-end font-w400">Superadmin</small> -->
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>

                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="./app-profile.html" class="dropdown-item ai-icon ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span class="ms-2">Profile </span>
                </a>
                <a href="./email-inbox.html" class="dropdown-item ai-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <span class="ms-2">Inbox </span>
                </a>
                <a href="{{route('logout')}}" class="dropdown-item ai-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    <span class="ms-2">Logout </span>
                </a>
            </div>
        </div>`
        <ul class="metismenu" id="menu">
            <li><a class="has-arrow " href="{{route('admin.dashboard')}}" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li><a class="has-arrow " href="{{route('user.index')}}" aria-expanded="false">
                    <i class="fa-solid fa-users"></i>
                    <span class="nav-text ">Users</span>
                </a>
            </li>

            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fa-solid fa-id-card"></i>
                    <span class="nav-text">Drivers</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('all_drivers.index')}}">All Drivers</a></li>
                    <li><a href="{{route('approved_drivers')}}">Approved Drivers</a></li>
                    <li><a href="{{route('pending_drivers')}}">Approval Pending Drivers</a></li>
                </ul>
            </li>

            <li><a class="has-arrow " href="{{route('coupons.index')}}" aria-expanded="false">
                    <i class="fa-solid fa-clipboard-check"></i>
                    <span class="nav-text ">Coupons</span>
                </a>
            </li>

            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fa-solid fa-address-card"></i>
                    <span class="nav-text">Incentives</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('prominent.index')}}">Prominent Place Rides</a></li>
                    <li><a href="{{route('targeted.index')}}">Targeted Rides</a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fa-solid fa-car"></i>
                    <span class="nav-text">Vehicle Outstation</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('vehicle.index')}}">Outstation Vehicle Type</a></li>
                    <li><a href="{{route('vehicle_booking.index')}}">Outstation Vehicle Booking
                        </a></li>
                </ul>
            </li>
            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fa-solid fa-truck-medical"></i>
                    <span class="nav-text">Vehicle Settings</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('vehicle_type.index')}}">Vehicle Type</a></li>
                    <li><a href="{{route('brand.index')}}">Brand</a></li>
                    <li><a href="{{route('car_model.index')}}">Car Model</a></li>
                </ul>
            </li>

            <li><a class="has-arrow " href="{{route('allRide.index')}}" aria-expanded="false">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span class="nav-text ">All Rides</span>
                </a>
            </li>

            <li><a class="has-arrow " href="{{route('complaints.index')}}" aria-expanded="false">
                    <i class="fa-solid fa-file-lines"></i>
                    <span class="nav-text ">Complaints</span>
                </a>
            </li>

            <li><a class="has-arrow " href="{{route('sos.index')}}" aria-expanded="false">
                    <i class="fa-solid fa-heart-pulse"></i>
                    <span class="nav-text ">SOS</span>
                </a>
            </li>

            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fa-solid fa-gear"></i>
                    <span class="nav-text">Administration Tools</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('commission.index')}}">Commision</a></li>
                    <li><a href="{{route('tax.index')}}">Tax Setting</a></li>
                    <li><a href="{{route('drive_document.index')}}">Driver Document</a></li>
                    <li><a href="{{route('settings.index')}}">Settings</a></li>
                </ul>
            </li>

            <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                    <i class="fa-solid fa-file-arrow-down"></i>
                    <span class="nav-text">Reports</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('userreport.index')}}">User Reports</a></li>
                    <li><a href="{{route('drive_document.index')}}">Driver Document</a></li>
                    <li><a href="{{route('settings.index')}}">Travel Report</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>