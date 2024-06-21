<form action="" method="get" class="relative md:w-[300px] w-full">
    <input type="text" name="search" placeholder="Search "
        class="border h-full outline-none rounded-lg px-4 py-3 text-[12px] w-full pe-7" value="{{ request('search') }}" id="input-table-search">
    <i class="isax icon-search-normal-1 absolute right-3 top-[12px] text-[#A6ACBE]"></i>
    {!! input_query(['search']) !!}
</form>
