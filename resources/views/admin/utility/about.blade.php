<x-layout.admin title="About Project">
    <div class="bg-white rounded-lg border mx-4 my-4 flex flex-col" method="POST" enctype='multipart/form-data'
        id="form-main-process">
        <div class="px-5 py-5 max-h-[calc(100vh-170px)] overflow-auto">
            <ul class="flex flex-col gap-3">
                <li class="flex text-[13px] font-krub-medium">
                    <strong class="w-[200px]">Version</strong>
                    <span class="text-[#A6ACBE]">{{ $version }}</span>
                </li>
                <li class="flex text-[13px] font-krub-medium">
                    <strong class="w-[200px]">Last Update</strong>
                    <span class="text-[#A6ACBE]">{{ $last_update }}</span>
                </li>
                <li class="flex text-[13px] font-krub-medium">
                    <strong class="w-[200px]">
                         Copyright
                    </strong>
                    <span class="text-[#A6ACBE]">
                         &copy; 2024 Muhammad Lailil Mahfud
                    </span>
                </li>
            </ul>
        </div>
    </div>
</x-layout.admin>
