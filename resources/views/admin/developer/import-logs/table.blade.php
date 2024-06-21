@foreach ($data as $row)
    <tr>
        <x-table.td>
            {{ $row->created_at->format('d M Y H:i:s') }}
        </x-table.td>
        <x-table.td>
            {{ $row->filename }}
        </x-table.td>
        <x-table.td>
            {{ $row->upload_by }}
        </x-table.td>
        <x-table.td>
            {{ $row->total_data }}
        </x-table.td>
        <x-table.td>
            {{ $row->progress }}%
        </x-table.td>
        <x-table.td>
            {{ $row->total_insert }}
        </x-table.td>
        <x-table.td>
            {{ $row->total_update }}
        </x-table.td>
        <x-table.td>
            {{ $row->total_skip ?: 0}}
        </x-table.td>
        <x-table.td>
            {{ $row->total_failed }}
        </x-table.td>
    </tr>
@endforeach
