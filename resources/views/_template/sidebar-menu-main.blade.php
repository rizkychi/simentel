@php
    $rute = request()->route()->getName();
    $count = substr_count($rute, '.');
    if ($count > 1) {
        $name = request()->segment(1) . '.' . request()->segment(2);
    } else {
        $name = request()->segment(1);
    }
    $child = [];
    foreach ((array) $list_menu as $idx => $menu) {
        foreach ((array) $menu->child as $child) {
            if (strpos($child->route, $name) !== false) {
                $child[$idx] = 'menu-open';
                break;
            }
        }
    }
@endphp
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach ($list_menu as $idx => $menu)
            <li class="nav-item {{ $child[$idx] }}">
                <a href="{{ $menu->route ? route($menu->route) : '#' }}" class="nav-link {{ strpos($menu->route,$name) !== false ? 'active':'' }}">
                    <i class="nav-icon {{ $menu->icon_type ?? 'fas' }} {{ $menu->icon ?? 'fa-circle' }}"></i>
                    <p>
                        {{ $menu->menu }}
                        @if ($menu->child)
                            <i class="fas fa-angle-left right"></i>
                        @endif
                    </p>
                </a>
                @if ($menu->child)
                    <ul class="nav nav-treeview">
                        @foreach ($menu->child as $child)
                            <li class="nav-item">
                                <a href="{{ $child->route ? route($child->route) : '#' }}" class="nav-link nav-child {{ strpos($child->route, $name) !== false ? 'active':'' }}">
                                    <i class="{{ $child->icon_type ?? 'fas' }} {{ $child->icon ?? 'fa-circle' }} nav-icon"></i>
                                    <p>{{ $child->menu }}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</nav>