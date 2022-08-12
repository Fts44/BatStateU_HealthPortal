<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('AdminDashboard') }}" id="sidebar_message">
                    <i class="bi bi-columns-gap"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('AdminInventoryMedicine') }}" id="sidebar_message">
                    <i class="bi bi-capsule-pill"></i>
                    <span>Medicine Inventory</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('AdminPatientUploads') }}" id="sidebar_message">
                    <i class="bi bi-filetype-doc"></i>
                    <span>Patient Uploads</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" id="sidebar_dashboard" data-bs-target="#user-nav" data-bs-toggle="collapse" >
                    <i class="bi bi-people"></i>
                    <span>Accounts</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="user-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('AdminPersonnel') }}">
                            <i class="bi bi-circle"></i><span>Infirmary Personnel</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('AdminPatient') }}">
                            <i class="bi bi-circle"></i><span>Patient</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="{{ url('admin/') }}" id="sidebar_dashboard">
                    <i class="bi bi-person"></i>
                    <span>Personal Info</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" id="sidebar_dashboard" data-bs-target="#sys-config-nav" data-bs-toggle="collapse" >
                    <i class="bi bi-gear"></i>
                    <span>Configuration</span>
                    <i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="sys-config-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('admin/configuration/gradelevel') }}">
                            <i class="bi bi-circle"></i><span>Education</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="bi bi-circle"></i><span>Infirmary</span>
                        </a>
                    </li>
                </ul>
            </li> -->
        </li>

    </ul>

</aside>