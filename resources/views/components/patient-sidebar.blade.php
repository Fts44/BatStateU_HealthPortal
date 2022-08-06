
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('patient/dashboard') }}" id="sidebar_message">
                <i class="bi bi-columns-gap"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('patient/message') }}" id="sidebar_message">
                <i class="bi bi-chat"></i>
                <span>Message</span>
            </a>
        </li> -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('patient/appointment') }}" id="sidebar_dashboard">
                <i class="bi bi-calendar4-week"></i>
                <span>Appointment</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('patient/documents') }}" id="sidebar_dashboard">
                <i class="bi bi-filetype-doc"></i>
                <span>Medical Documents</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('patient/') }}" id="sidebar_dashboard">
                <i class="bi bi-person"></i>
                <span>Personal Info</span>
            </a>
        </li>
    </li>

</ul>

</aside>