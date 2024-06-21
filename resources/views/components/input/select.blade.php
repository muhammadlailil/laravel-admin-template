<div class="flex items-baseline w-full {{ @$isCol ? 'flex-col' : 'gap-2' }}">
    @if (@$label)
        <div class="flex-1 min-w-[170px] form-label block">
            <label for="{{ $id }}" class="text-[12px]">
                {{ $label }}
            </label>
            @if (@$required)
                <span class="text-red-500 text-[12px] font-krub-bold">*</span>
            @endif
        </div>
    @endif
    <div class="relative w-full">
        <select {{ $attributes }}
            class="border outline-none text-[13px] px-4 py-[12px] w-full col-span-2 rounded-lg appearance-none {{@$elementClass}} {{ $errors->has($name) ? 'border-[#EA120C]' : '' }}">
            {{ $slot }}
        </select>
        <i class="isax icon-arrow-down-1 absolute right-4 top-[14px] z-[1]"></i>
        @if ($errors->has($name))
            <span class="text-[#EA120C] font-krub-medium text-[11px]">{{ $errors->first($name) }}</span>
        @endif
        @if (@$information)
            <span class="text-[11px] text-[#A6ACBE]">{{ $information }}</span>
        @endif
    </div>
</div>
