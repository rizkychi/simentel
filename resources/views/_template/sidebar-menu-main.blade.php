@php
    $name = request()->route()->getName();
@endphp
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach ($list_menu as $menu)
            <li class="nav-item nav-parent">
                <a href="{{ $menu->route ? route($menu->route) : '' }}" class="nav-link {{ $name == $menu->route ? 'active':'' }}">
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
                                <a href="{{ $child->route ? route($child->route) : '' }}" class="nav-link nav-child {{ $name == $child->route ? 'active':'' }}">
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

@push('scripts')
<script type="text/javascript">
    $(function() {
        $('.nav-child').each(function(i, obj){
            if ($(this).hasClass('active')) {
                $(this).closest('.nav-parent').addClass('menu-is-opening menu-open')
            }
        })
    })
</script>
@endpush