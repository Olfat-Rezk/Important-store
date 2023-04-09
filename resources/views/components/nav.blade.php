<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @foreach ( $items as $item)
            <li class="nav-item has-treeview menu-open">
                <a href="{{ route($item['route']) }}" class="nav-link {{ Route::is($active)?'active':'' }}">
                    <i class="{{ $item['icon'] }}"></i>
                    <p>
                       {{$item['title']}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

            </li>
        @endforeach
    </ul>
</nav>
<!-- /.sidebar-menu -->

