<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Noto Sans'>

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

    .noti-icon {
        margin-right: -10px; /* Adjust this value to control the spacing */
    }

    /* Custom modal styling */
    .modal-content-custom {
        width: 550px;
        border-radius: 25px;
        border: 3px solid #FFF;
        background: var(--soft-green-light-hover, #E6F4E4);
        box-shadow: 0px 25px 40px 0px rgba(0, 0, 0, 0.10);
        transform: scale(0.9);
    }

    .btn-mod,
    .btn-mod:hover,
    .btn-mod:focus {
        border: none;
        background: transparent;
    }

    .card-mod {
        width: 450px;
        border-radius: 20px;
        background: #FFF;
        box-shadow: 0px 4px 10px 0px rgba(0, 0, 0, 0.10);
    }

    .modal-dialog-custom {
        margin-top: -20px !important;
    }

    body {
        font-family: 'Noto Sans', sans-serif;
    }
</style>

<header id="page-topbar" style="zoom: 0.9;">
    <div class="navbar-header">
        <div class="d-flex align-items-center">
            <h2 class="text-white" style="position: fixed;">@yield('title')</h2>
        </div>

        <div class="d-flex">
            <div class="ms-2" id="currentDateContainer"></div>
                <button type="button" class="btn header-item noti-icon" data-bs-toggle="fullscreen">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 36 36" fill="none">
                        <path d="M12 28.5002V24.0002H7.5V21.0002H15V28.5002H12ZM21 28.5002V21.0002H28.5V24.0002H24V28.5002H21ZM7.5 15.0002V12.0002H12V7.50024H15V15.0002H7.5ZM21 15.0002V7.50024H24V12.0002H28.5V15.0002H21Z" fill="white"/>
                    </svg>
                </button>
                <button type="button" class="btn header-item" data-bs-toggle="modal" data-bs-target="#creditModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 34 34" fill="none">
                        <path d="M17.0001 7.80581C17.7934 7.80581 18.5867 8.30164 19.1817 9.30747L27.5542 23.2616C28.7726 25.2733 27.8376 26.9166 25.5001 26.9166H8.50005C6.16255 26.9166 5.22755 25.2733 6.43172 23.2758L14.8042 9.32164C15.4134 8.30164 16.2067 7.80581 17.0001 7.80581ZM17.0001 4.97247C15.1584 4.97247 13.4867 6.02081 12.3817 7.84831L4.00922 21.8166C3.38589 22.865 3.07422 23.9416 3.07422 24.9758C3.07422 25.7691 3.27255 26.5483 3.66922 27.2425C4.57589 28.8291 6.33255 29.75 8.50005 29.75H25.5001C27.6676 29.75 29.4242 28.8291 30.3309 27.2425C30.7417 26.52 30.9401 25.7266 30.9259 24.905C30.9117 23.8991 30.6001 22.8366 29.9909 21.8166L21.6184 7.86247C20.5134 6.02081 18.8417 4.97247 17.0001 4.97247ZM19.1251 23.7291C19.1251 23.7291 18.1192 24.2391 17.6092 23.9841C17.0992 23.7291 17.0001 23.2191 17.2834 22.355L17.8642 20.6266C18.4309 18.8983 17.6942 17.68 16.3342 17.6091C14.5492 17.51 13.4726 18.785 13.4726 18.785C13.4726 18.785 14.4784 18.275 14.9884 18.53C15.4984 18.785 15.5976 19.295 15.3142 20.1591L14.7334 21.8875C14.1667 23.6158 14.9034 24.82 16.2634 24.905C18.0484 24.99 19.1251 23.7291 19.1251 23.7291Z" fill="white"/>
                        <path d="M17 16.0083C18.0171 16.0083 18.8417 15.1838 18.8417 14.1667C18.8417 13.1496 18.0171 12.325 17 12.325C15.9829 12.325 15.1583 13.1496 15.1583 14.1667C15.1583 15.1838 15.9829 16.0083 17 16.0083Z" fill="white"/>
                    </svg>
                </button>

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

<!-- Modal structure -->
<div class="modal fade" id="creditModal" tabindex="-1" aria-labelledby="creditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-custom d-flex align-items-center justify-content-center">
        <div class="modal-content modal-content-custom">
            <div class="modal-header">
                <h5 class="modal-title" id="creditModalLabel"></h5>
                <button type="button" class="btn-mod" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 65 65" fill="none">
                        <path d="M36.3297 32.5L43.9915 24.8409C44.4997 24.3327 44.7852 23.6434 44.7852 22.9247C44.7852 22.206 44.4997 21.5168 43.9915 21.0086C43.4833 20.5004 42.7941 20.2149 42.0754 20.2149C41.3567 20.2149 40.6674 20.5004 40.1592 21.0086L32.5001 28.6704L24.8409 21.0086C24.3327 20.5004 23.6435 20.2149 22.9248 20.2149C22.2061 20.2149 21.5168 20.5004 21.0086 21.0086C20.5004 21.5168 20.2149 22.206 20.2149 22.9247C20.2149 23.6434 20.5004 24.3327 21.0086 24.8409L28.6705 32.5L21.0086 40.1592C20.5004 40.6674 20.2149 41.3566 20.2149 42.0753C20.2149 42.794 20.5004 43.4833 21.0086 43.9915C21.5168 44.4997 22.2061 44.7852 22.9248 44.7852C23.6435 44.7852 24.3327 44.4997 24.8409 43.9915L32.5001 36.3296L40.1592 43.9915C40.6674 44.4997 41.3567 44.7852 42.0754 44.7852C42.7941 44.7852 43.4833 44.4997 43.9915 43.9915C44.4997 43.4833 44.7852 42.794 44.7852 42.0753C44.7852 41.3566 44.4997 40.6674 43.9915 40.1592L36.3297 32.5ZM32.5001 59.5833C17.542 59.5833 5.41675 47.4581 5.41675 32.5C5.41675 17.5419 17.542 5.41669 32.5001 5.41669C47.4582 5.41669 59.5834 17.5419 59.5834 32.5C59.5834 47.4581 47.4582 59.5833 32.5001 59.5833Z" fill="#595959"/>
                    </svg>
                </button>
            </div>

            <div class="text-center" style="margin-top: -35px;">
                <img src="/assets/images/logo_project.webp" alt="" height="150">
            </div>
                <!-- Add three vertically stacked cards with specified style -->
                <div class="d-flex flex-column align-items-center mt-4">
                <div class="card card-mod" style="margin-top: 10px;">
                <div class="card-body">
                    <div style="color: var(--neutral-darker, #595959); text-align: center; font-family: 'Product Sans Light', sans-serif; font-size: 14px; font-weight: 300; line-height: normal; letter-spacing: 2px;">
                        Powered by:
                    </div>
                    <div style="color: var(--neutral-darker, #595959); text-align: center; font-family: 'Product Sans Black', sans-serif; font-size: 22px; font-weight: 900; line-height: normal;">
                        Candal Rutin III
                    </div>
                    <div style="color: var(--neutral-darker, #595959); text-align: center; font-family: 'Product Sans', sans-serif; font-size: 13px; font-weight: 400; line-height: normal;">
                        Dept. Perencanaan Strategi Pemeliharaan<br>
                        Komp. Rendal Har | PT Petrokimia Gresik
                    </div>
                </div>
                </div>
                <div class="card card-mod" style="margin-top: -10px;">
                <div class="card-body">
                    <div style="color: var(--neutral-darker, #595959); text-align: center; font-family: 'Product Sans Black', sans-serif; font-size: 22px; font-weight: 900; line-height: normal;">
                        Rheza Firmansyah
                    </div>
                    <div style="color: var(--neutral-darker, #595959); text-align: center; font-family: 'Product Sans', sans-serif; font-size: 13px; font-weight: 400; line-height: normal;">
                        Project Manager
                    </div>
                </div>
                </div>
                <div class="card card-mod" style="margin-top: -10px;">
                <div class="card-body">
                    <div style="color: var(--neutral-darker, #595959); text-align: center; font-family: 'Product Sans Black', sans-serif; font-size: 22px; font-weight: 900; line-height: normal;">
                        M. Arienal Haq
                    </div>
                    <div style="color: var(--neutral-darker, #595959); text-align: center; font-family: 'Product Sans', sans-serif; font-size: 13px; font-weight: 400; line-height: normal;">
                        Web Developer
                    </div>
                </div>
                </div>
                <div class="card card-mod" style="margin-top: -10px;">
                <div class="card-body">
                    <div style="color: var(--neutral-darker, #595959); text-align: center; font-family: 'Product Sans Black', sans-serif; font-size: 22px; font-weight: 900; line-height: normal;">
                        Mirza Gozali
                    </div>
                    <div style="color: var(--neutral-darker, #595959); text-align: center; font-family: 'Product Sans', sans-serif; font-size: 13px; font-weight: 400; line-height: normal;">
                        UI/UX Designer
                    </div>
                </div>
                </div>
                <div class="modal-footer"> <!-- Add margin-top to the footer -->
                </div>
            </div>
        </div>
    </div>
</div>

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
