<div class="flex gap-2 items-baseline w-full {{@$isCol ? 'flex-col' : ''}}" x-data="{ see: false }">
    <div class="flex-1 min-w-[170px] form-label block">
        <label for="{{ $id }}" class="text-[12px]">
            {{ $label }}
        </label>
        @if (@$required)
            <span class="text-red-500 text-[12px] font-krub-bold">*</span>
        @endif
    </div>
    <div class="w-full relative">
        <input {{ $attributes }} x-bind:type="!see ? 'password' : 'text'"
            class="border outline-none text-[13px] pe-9 px-4 py-[12px] w-full col-span-2 rounded-lg {{ $errors->has($name) ? 'border-[#EA120C]' : '' }}">
        <i class="isax icon absolute right-4 top-[14px] cursor-pointer"
            x-bind:class="{
                'icon-eye': !see,
                'icon-eye-slash': see
            }"
            x-on:click="see=!see"></i>
        @if ($errors->has($name))
            <span class="text-[#EA120C] font-krub-medium text-[11px]">{{ $errors->first($name) }}</span>
        @endif
        @if (@$information)
            <span class="text-[11px] text-[#A6ACBE]">{{ $information }}</span>
        @endif
    </div>
</div>
