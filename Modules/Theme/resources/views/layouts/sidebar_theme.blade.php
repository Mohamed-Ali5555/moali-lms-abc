    @if (has_permission('admin.theme.settings'))
        <li
            class="sidebar-second-li {{ $current_route == 'admin.theme.settings' ? 'active' : '' }}">
            <a
                href="{{ route('admin.theme.settings') }}">{{ get_phrase('settings theme') }}</a>
        </li>
    @endif




    @if (has_permission('admin.theme.settings.social'))
        <li
            class="sidebar-second-li {{ $current_route == 'admin.theme.social' ? 'active' : '' }}">
            <a
                href="{{ route('admin.theme.social') }}">{{ get_phrase('settings theme social') }}</a>
        </li>
    @endif



    
    @if (has_permission('admin.theme.settings.feature'))
        <li
            class="sidebar-second-li {{ $current_route == 'admin.theme.feature' ? 'active' : '' }}">
            <a
                href="{{ route('admin.theme.feature') }}">{{ get_phrase('settings theme feature') }}</a>
        </li>
    @endif