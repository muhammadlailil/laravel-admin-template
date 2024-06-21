<div x-on:keydown.escape.window="filterForm = false" class="relative z-50 w-auto h-auto">
    <button type="button" id="btn-toogle-filterForm" class="hidden" x-on:click="filterForm=!filterForm"></button>
    <div x-show="filterForm" x-hidden-first
        class="hidden fixed top-0 left-0 z-[99] items-center justify-center w-screen h-screen">
        <div x-show="filterForm" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-on:click="filterForm=false"
            class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
        <div x-show="filterForm" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative w-full py-5 bg-white px-6 sm:max-w-md sm:rounded-lg">
            <div class="flex items-center justify-between pb-2 mb-3">
                <h3 class="text-lg font-semibold" id="form-filter-title">Filter</h3>
                <a href="{{$reset}}" x-on:click="filterForm=false"
                    class="bg-[#B22041] text-white rounded-md text-[12px] px-3 py-[5px]">
                    Reset Filter
                </a>
            </div>
            <form method="GET" id="form-filter" class="flex flex-col gap-4 items-center justify-center w-auto  -mx-6">
                <div class="justify-start block w-full">
                    {{ $slot }}
                </div>
                <div class="flex gap-3 mt-5 px-6">
                    <x-button.grey x-on:click="filterForm=false" type="button" label="Cancel"
                        elementClass="py-[10px] w-[100px]" />
                    <x-button.orange type="submit" label="Filter" elementClass="py-[10px] w-[100px]" />
                </div>
            </form>
        </div>
    </div>
</div>
