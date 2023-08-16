<header id="page-topbar" style="zoom: 0.9;">
    <div class="navbar-header">
        <div class="d-flex align-items-center">
            <h2 class="text-white" style="position: fixed;">@yield('title')</h2>
        </div>

        <div class="d-flex">
        <div class="ms-2" id="currentDateContainer"></div>
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon" data-bs-toggle="fullscreen">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 36 36" fill="none">
                        <path d="M12 28.5002V24.0002H7.5V21.0002H15V28.5002H12ZM21 28.5002V21.0002H28.5V24.0002H24V28.5002H21ZM7.5 15.0002V12.0002H12V7.50024H15V15.0002H7.5ZM21 15.0002V7.50024H24V12.0002H28.5V15.0002H21Z" fill="white"/>
                    </svg>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0" key="t-notifications"> Notifications </h6>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        @foreach($notivications as $notivication)
                        <a href="{{ route('notivication.show', $notivication->id) }}" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM11 15H13V17H11V15ZM11 7H13V13H11V7Z" fill="rgba(255,255,255,1)"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1" key="t-your-order">New {{ $notivication->model }} from {{
                                        $notivication->user->name }}</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span key="t-min-ago">{{
                                                $notivication->created_at->diffForHumans() }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span key="t-view-more">View
                                More..</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ $user->avatar ? asset('assets/user/image/' . $user->avatar) : '/assets/images/users/avatar-1.jpg' }}" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry" style="color: #FFF; font-style: normal; font-weight: 400; line-height: normal; letter-spacing: 0.88px;">{{ $user->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block" style="color: white;"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('user.profile.index') }}">
                        <i class="bx bx-user font-size-16 align-middle me-1"></i>
                        <span key="t-profile">Profile</span>
                    </a>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#changePassword">
                        <i class="bx bx-edit font-size-16 align-middle me-1"></i>
                        <span key="t-change-password">Change Password</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit()">
                        <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                        <span key="t-logout">Logout</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" id="form-logout">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="changePasswordLabel">Change Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.change-password') }}" method="post">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="inputPassword5" class="form-label">Password</label>
                        <input type="password" id="inputPassword5" class="form-control" name="password">
                        <x-form.validation.error name="password" />
                    </div>

                    <div class="mb-3">
                        <label for="inputPassword5" class="form-label">Password Confirm</label>
                        <input type="password" id="inputPassword5" class="form-control" name="password_confirmation">
                        <x-form.validation.error name="password_confirmation" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    #page-topbar {
    width: 100%;
    height: 60px;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 90; /* Lower z-index value for the topbar */
    background: linear-gradient(90deg, #FEB300 0%, #07834D 100%);
    box-shadow: 0px 20px 30px -12px rgba(0, 0, 0, 0.16);
    }
    
    #page-topbar .navbar-header {
        display: flex;
        align-items: center; /* Center vertically */
        justify-content: space-between;
    }

    #page-topbar h2 {
        margin: 0;
        color: #FFF;
        font-size: 30px;
        font-style: normal;
        font-weight: 900;
        line-height: normal;
    }

    #page-topbar .d-flex.align-items-center {
        display: flex;
        align-items: center;
        margin-left: 280px; /* Add margin to this element */
        margin-top: -11px;
    }

    #page-topbar .d-flex {
        display: flex;
        align-items: center;
        margin-right: 10px;
        margin-top: -11px;
    }

    /* Remove hover effect and other styles */
    #page-header-user-dropdown:hover,
    #page-header-user-dropdown:focus {
        background-color: initial;
        box-shadow: none;
        border: none;
    }
</style>

<script>
    // Get the current date
    var currentDate = new Date();

    // Define an array of Indonesian day and month names
    var indonesianDayNames = [
        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
    ];
    var indonesianMonthNames = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    // Get the day, day name, month, and year
    var day = currentDate.getDate();
    var dayName = indonesianDayNames[currentDate.getDay()];
    var month = currentDate.getMonth();
    var year = currentDate.getFullYear();

    // Format the date
    var formattedDate = dayName + ', ' + day + ' ' + indonesianMonthNames[month] + ' ' + year;

    // Update the content of the currentDateContainer
    document.getElementById('currentDateContainer').innerHTML = '<p class="mb-0 text-white">' + formattedDate + '</p>';
</script>
