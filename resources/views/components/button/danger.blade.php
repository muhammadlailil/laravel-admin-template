@if (@$href)
    <a {{ $attributes }}
        class="bg-[#D12D4E]  text-white  px-4 py-3 rounded-lg text-[12px] font-krub-semibold flex items-center justify-center gap-2 disabled:bg-[#ddd] disabled:cursor-not-allowed {{@$elementClass}}">
        {{ $label }}
        @if (@$icon)
            <i class="isax {{ $icon }} text-[16px]"></i>
        @endif
    </a>
@else
    <button {{ $attributes }}
        class="bg-[#D12D4E]  text-white  px-4 py-3 rounded-lg text-[12px] font-krub-semibold flex items-center justify-center gap-2 disabled:bg-[#ddd] disabled:cursor-not-allowed {{@$elementClass}}">
        {{ $label }}
        @if (@$icon)
            <i class="isax {{ $icon }} text-[16px]"></i>
        @endif
    </button>
@endif
