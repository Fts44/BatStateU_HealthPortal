<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="#" class="logo d-flex align-items-center">
            <img src="{{ asset('image/logo.png') }}" alt="school_logo">
            <span class="d-none d-lg-block ms-1">Health Services Portal</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn" id="hamburgerMenu"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">

        <ul class="d-flex align-items-center">
    
            <li class="nav-item dropdown px-3">

                <a class="nav-link nav-logout d-flex align-items-center" href="{{ route('Logout') }}">
                    <i class="bi bi-power" style="font-size: 1rem;"></i>
                    <span class="d-none d-md-block ps-2">Logout</span>
                </a>
                
            </li>
            
        </ul>
    </nav><!-- End Icons Navigation -->

</header>