<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="/dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @if (Auth::user()->hasRole('admin'))
            <!-- Staff Management -->
            <li class="nav-item">
                <a class="nav-link {{ !request()->is('teacher/index') && !request()->is('register') ? 'collapsed' : '' }}"
                    data-bs-target="#teacher_nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>Teacher Management</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="teacher_nav"
                    class="nav-content {{ request()->is('teacher/index') || request()->is('register') ? 'collapse show' : 'collapse' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/teacher/index"
                            class="{{ request()->is('teacher/index') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>View Teacher</span>
                        </a>
                    </li>
                    <li>
                        <a href="/register" class="{{ request()->is('register') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Register a Teacher</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Staff Management -->

            <!-- Stream Management -->
            <li class="nav-item">
                <a class="nav-link {{ !request()->is('stream/index') && !request()->is('stream/create') ? 'collapsed' : '' }}"
                    data-bs-target="#stream_nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>Stream Management</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="stream_nav"
                    class="nav-content {{ request()->is('stream/index') || request()->is('stream/create') ? 'collapse show' : 'collapse' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/stream/index"
                            class="{{ request()->is('stream/index') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>View stream</span>
                        </a>
                    </li>
                    <li>
                        <a href="/stream/create" class="{{ request()->is('stream/create') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Create Stream </span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Stream Management -->

            <!-- Subject Management -->
            <li class="nav-item">
                <a class="nav-link {{ !request()->is('subject/index') && !request()->is('subject/create') ? 'collapsed' : '' }}"
                    data-bs-target="#subject_nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person"></i><span>Subject Management</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="subject_nav"
                    class="nav-content {{ request()->is('subject/index') || request()->is('subject/create') ? 'collapse show' : 'collapse' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/subject/index"
                            class="{{ request()->is('subject/index') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>View Subject</span>
                        </a>
                    </li>
                    <li>
                        <a href="/subject/create" class="{{ request()->is('subject/create') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Create Subject </span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Subject Management -->

        @endif
    </ul>
</aside>
