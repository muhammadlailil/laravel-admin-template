<div class="flex gap-2 items-center relative">
    <input type="checkbox" @checked(@$attributes['selected']) {{ $attributes }} class="w-[1px] h-[1px] border border-[#ddd] input-checkbox">
    <label for="{{ $id }}" class="text-[12px] ms-4 cursor-pointer">
        {{ $label }}
    </label>
</div>
