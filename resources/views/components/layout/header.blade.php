@php
    $admin = admin()->user;
@endphp
<header class="flex justify-between items-center border-b px-4 sticky top-0 py-2 z-[10] bg-[#B22041] text-white">
    <div>
        <h1 class="font-krub-semibold text-[19px]">
            {{ $title }}
        </h1>
        @if (@$breadcrumb)
            <ul class="flex gap-2 text-[10px] font-krub-medium text-white">
                @foreach ($breadcrumb as $nav)
                    <li>
                        @if (!@$nav['url'])
                            <span class="text-[#FF9401] active-breadcrumb">{{ @$nav['label'] }}</span>
                        @else
                            <a href="{{ @$nav['url'] }}">{{ @$nav['label'] }}</a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <div class="flex gap-6 items-center">
        <div x-data="{ dropdownNotification: false }" class="relative">
            <button type="button" class="mt-[6px] rounded-full px-2 py-1 pb-0 relative" x-ref="dropdownNotification"
                x-on:click="dropdownNotification=true">
                <i class="isax-b icon-notification text-[20px]"></i>
                @if($notification->total)
                <span
                    class="bg-[#FF9401] border-2 border-white text-white text-[8px] absolute right-0 top-0 px-[5px] py-[1px] flex items-center justify-center rounded-full">
                    {{$notification->total}}
                </span>
                @endif
            </button>

            <div x-show="dropdownNotification" x-clock x-on:click.away="dropdownNotification=false"
                x-anchor.bottom-end="$refs.dropdownNotification" class="absolute z-50 mt-1 w-fit whitespace-nowrap">
                <div
                    class="py-1 px-3 bg-white border rounded-md shadow-sm border-neutral-200/70 min-w-72 text-neutral-700 pb-0">
                    <div class="border-b py-2 text-[12px] font-krub-semibold">
                        <p>Notification</p>
                    </div>
                    <ul class="overflow-auto max-h-[300px] -mx-3 px-3 flex flex-col gap-2 py-3">
                        @if(!$notification->total)
                        <li
                            class="flex flex-col items-center justify-center"
                        >
                            <img src="{{ asset('assets/img/emty-state.png') }}" alt="No Data Icon" class="h-[100px]">
                            <span class="inline-block mt-4 text-[13px]">
                                No Results Found
                            </span>
                        </li>
                        @else
                            @foreach($notification->items as $notif)
                                <li class="border-b pb-2">
                                    <div class="flex gap-2 items-center">
                                        <div class="bg-white rounded-full text-white flex justify-center items-center">
                                            <i class="isax-b icon-tick-circle text-[42px] text-[#029E2D]"></i>
                                        </div>
                                        <div class="flex flex-col">
                                            <p class="text-[#333030] font-krub-bold text-[13px] mb-0">
                                                {{$notif->title}}
                                            </p>
                                            <span class="text-[#888888] text-[12px] font-krub-regular">
                                                {{$notif->description}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ms-[50px] mt-1 mb-2">
                                        <a
                                            href="{{route('admin.notification.detail',$notif->uuid)}}"
                                            class="text-[10px] text-white bg-[#FF9401] rounded-md px-3 py-[6px] w-fit"
                                        >
                                            View Detail
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    @if($notification->total)
                    <div class="border-t py-2 text-[12px] font-krub-semibold mt-2">
                        <a href="{{route('admin.notification.index')}}" class="text-[#FF9401] underline">
                            View All Notification
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div x-data="{ dropdownOpen: false }" class="relative">
            <button type="button" x-on:click="dropdownOpen=true"
                class="flex gap-2 items-center py-1 font-krub-medium text-[12px]" x-ref="buttonDropdownProfile">
                <img src="{{ asset($admin->profile) }}" alt="Profile User"
                    class="w-[35px] h-[35px] rounded-full object-cover">
                {{ $admin->name }}
                <i class="isax icon-arrow-down-1 ms-1 text-[15px]"></i>
            </button>

            <div x-show="dropdownOpen" x-hidden-first x-on:click.away="dropdownOpen=false"
                x-anchor.bottom-end="$refs.buttonDropdownProfile"
                class="absolute z-50 mt-4 -right-1 top-0 w-fit whitespace-nowrap hidden">
                <div
                    class="py-2 bg-white border rounded-md shadow-md font-krub-semibold border-neutral-200/70 w-fit min-w-[160px] text-neutral-700">
                    <ul class="text-[#D12D4E] font-krub-medium text-[12px] px-1">
                        {{-- <li>
                            <a href="" class="block hover:bg-[#F5F6FA] px-3 py-[7px] rounded-md">Activity Log</a>
                        </li> --}}
                        <li>
                            <a href="{{ route('admin.profile.index') }}"
                                class="block hover:bg-[#F5F6FA] px-3 py-[7px] rounded-md">Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.about') }}"
                                class="block hover:bg-[#F5F6FA] px-3 py-[7px] rounded-md">About</a>
                        </li>
                        <li>
                            <button type="button" data-toggle="confirmation"
                                data-message="Are you sure you want to leave this page?"
                                data-action="{{ route('admin.auth.logout') }}"
                                class="block hover:bg-[#F5F6FA] px-3 py-[7px] w-full text-start rounded-md ">
                                Logout
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
