@if (@$href)
    <a {{ $attributes }}
        class=" {{@$elementClass}} bg-[#F5F6FA] text-[#FF9401] border-[#FF9401] border px-4 py-2 rounded-lg text-[12px] font-krub-semibold flex items-center justify-center gap-2 disabled:bg-[#ddd] disabled:cursor-not-allowed">
        @if (@$icon)
            <i class="isax {{ $icon }} text-[#FF9401] text-[16px]"></i>
        @endif
        {{ $label }}
    </a>
@else
    <button {{ $attributes }}
        class="bg-[#F5F6FA] text-[#FF9401] border-[#FF9401] border px-4 py-2 rounded-lg text-[12px] font-krub-semibold flex items-center justify-center gap-2 disabled:bg-[#ddd] disabled:cursor-not-allowed {{@$elementClass}}">
        @if (@$icon)
            <i class="isax {{ $icon }} text-[#FF9401] text-[16px]"></i>
        @endif
        {{ $label }}
    </button>
@endif
