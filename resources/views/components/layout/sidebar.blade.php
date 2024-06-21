<aside class="w-sidebar border-r h-screen flex flex-col fixed bg-white main-sidebar z-[2]" x-data={}>
    <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center justify-center pt-6 pb-3 app-logo">
        <img src="{{ asset('assets/img/app-logo.png') }}" alt="Application Logo" class="h-[30px]">
    </a>
    <nav class="px-2 pt-4 overflow-auto flex-1">
        <ul>
            @foreach (admin()->modules as $group => $menus)
                <li class="mb-4 nav-item">
                    <span
                        class="text-[#A6ACBE] font-krub-medium text-[11px] mb-1 ms-3 block menu-name">{{ $group }}</span>
                    <ul>
                        @foreach ($menus as $menu)
                            <li>
                                <a href="{{ adminUrl($menu['url']) }}" {{ activeMenu($menu['url']) }}
                                    class="hover:bg-[#FEF2F3] hover:text-[#D12D4E] hover:border-l-4 hover:ps-2 border-[#D12D4E] font-krub-medium flex items-center gap-2 rounded-md px-3 py-2 mb-1 text-[13px] nav-link">
                                    <i class="{{ $menu['icon'] }} text-[17px]"></i>
                                    <span class="menu-name"
                                        x-bind:class="collapseMenu ? 'whitespace-nowrap' : ''">{{ $menu['name'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
            @if (admin()->user?->is_superadmin)
                <li class="mb-4 nav-item ">
                    <span class="text-[#A6ACBE] font-krub-medium text-[11px] mb-1 ms-3 block menu-name">Developer</span>
                    <ul>
                        <li>
                            <a href="{{ route('admin.role-permission.index') }}" {{ activeMenu('role-permission') }}
                                class="hover:bg-[#FEF2F3] hover:text-[#D12D4E] hover:border-l-4 hover:ps-2 border-[#D12D4E] font-krub-medium flex items-center gap-2 rounded-md px-3 py-2 mb-1 text-[13px] nav-link">
                                <i class="isax icon-user-tag text-[17px]"></i>
                                <span class="menu-name" x-bind:class="collapseMenu ? 'whitespace-nowrap' : ''">Roles &
                                    Permission</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>
    <button type="button"
        class="border-2 border-[#D12D4E] rounded-full w-[35px] h-[35px] text-[##0A162F] flex items-center justify-center absolute bg-white right-[-17px] bottom-[70px]"
        x-on:click="sidebarCollapse=!sidebarCollapse;collapseMenu=true;setTimeout(()=>{collapseMenu=!collapseMenu},400)">
        <i class="isax icon-arrow-right-3 text-[18px] text-[#D12D4E] transition-all"
            x-bind:class="sidebarCollapse ? '' : 'rotate-180'"></i>
    </button>
</aside>
