<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ set_active(['devina-cashbook.buku-kas.list.page']) }}"><a href="{{ route('devina-cashbook.buku-kas.list.page') }}"><i class="fas fa-tachometer-alt mr-2"></i><span> Dashboard Kas</span></a></li>
                <li class="submenu"><a href="#"><i class="fas fa-cog mr-2"></i><span> Pengaturan Kas </span><span class="menu-arrow"></span></a>
                    <ul class="submenu_class" style="display: none;">
                        <li><a class="{{ set_active(['matauang/list/page']) }}" href="{{ route('matauang/list/page') }}"><i class="fas fa-money-check-alt mr-3"></i>Mata Uang</a></li>
                    </ul>
                </li>
                <li class="mt-2"><a href="{{ route('home') }}"><i class="fas fa-chevron-left mr-2"></i> Kembali ke Dashboard</a></li>
            </ul>
        </div>
    </div>
</div>
