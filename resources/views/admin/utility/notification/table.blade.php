@foreach ($data as $row)
    <tr>
        <x-table.td>
            <a href="{{ route('admin.notification.detail', $row->uuid) }}"
                class="text-[10px] text-white bg-[#FF9401] rounded-md px-3 py-[6px] w-fit">
                View Detail
            </a>
        </x-table.td>
        <x-table.td>
            {{ $row->created_at->format('d M Y H:i:s') }}
        </x-table.td>
        <x-table.td>
            {{ $row->title }}
        </x-table.td>
        <x-table.td>
            {{ $row->description }}
        </x-table.td>
        <x-table.td>
            {{ $row->is_read ? 'Read' : 'New' }}
        </x-table.td>
    </tr>
@endforeach
