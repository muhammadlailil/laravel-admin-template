<div class="flex gap-2 items-start w-full {{ @$isCol ? 'flex-col' : '' }}">
    <div class="flex-1 min-w-[170px] form-label block">
        <label for="{{ $id }}" class="text-[12px]">
            {{ $label }}
        </label>
        @if (@$required)
            <span class="text-red-500 text-[12px] font-krub-bold">*</span>
        @endif
    </div>
    <div class="w-full">
        <textarea {{ $attributes }}
            class="border outline-none text-[13px] px-4 py-[12px] w-full col-span-2 rounded-lg {{ $errors->has($name) ? 'border-[#EA120C]' : '' }}"></textarea>
        @if ($errors->has($name))
            <span class="text-[#EA120C] font-krub-medium text-[11px]">{{ $errors->first($name) }}</span>
        @endif
        @if (@$information)
            <span class="text-[11px] font-krub-medium text-[#A6ACBE]">{{ $information }}</span>
        @endif
    </div>
</div>
