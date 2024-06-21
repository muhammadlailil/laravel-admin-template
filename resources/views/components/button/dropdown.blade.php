<div class="hidden" x-hidden-first x-data="{ dropdownOpen: false }">
    <button type="button" x-on:click="dropdownOpen=true"  x-ref="buttonDotDropdown"
        class="bg-[#F5F6FA] shadow-sm rounded-lg font-krub-semibold border text-[11px] px-3 py-[5px] flex items-center gap-1 dropdownButton">
        {{ $label }}
        <i class="isax icon-arrow-down-1 text-[14px]"></i>
    </button>
    <ul x-show="dropdownOpen" x-on:click.away="dropdownOpen=false"
        class="top-5 absolute bg-white border rounded-md text-left w-fit right-0 mt-1 z-10 py-1 dropdown-button-main text-[#B22041] font-krub-semibold text-[11px] px-1"
        x-transition:enter-start="-translate-y-2" x-transition:enter-end="translate-y-0"
        x-anchor.bottom-start="$refs.buttonDotDropdown">
        {{ $slot }}
    </ul>
</div>
