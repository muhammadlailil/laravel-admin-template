<div class="flex items-baseline w-full {{ @$isCol ? 'flex-col' : 'gap-2 ' }}">
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
    <div class="w-full relative">
        <input {{ $attributes }}
            class="border outline-none text-[13px] px-4 py-[12px] w-full col-span-2 rounded-lg disabled:bg-[#edededad] {{ $errors->has($name) ? 'border-[#EA120C]' : '' }}">
        @if(@$attributes['type']=='date')
        <i class="isax icon-calendar-2 right-4 top-[15px] absolute"></i>
        @endif
        @if ($errors->has($name))
            <span class="text-[#EA120C] font-krub-medium text-[11px]">{{ $errors->first($name) }}</span>
        @endif
        @if (@$information)
            <span class="text-[11px] font-krub-medium text-[#A6ACBE]">{{ $information }}</span>
        @endif
    </div>
</div>
