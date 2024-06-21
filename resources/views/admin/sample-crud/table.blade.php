@foreach ($data as $row)
    <tr>
        <x-table.td>
            <div class="flex gap-2 justify-start">
                <x-button.edit href="{{ adminRoute('admin.factory-line.edit', $row->uuid) }}" />
                <x-button.delete data-action="{{ adminRoute('admin.factory-line.destroy', $row->uuid) }}" />
            </div>
        </x-table.td>
        <x-table.td>
            {{ $row->line_number }}
        </x-table.td>
        <x-table.td>
            {{ $row->name }}
        </x-table.td>
        <x-table.td>
            {{ $row->employee_count }}
        </x-table.td>
    </tr>
@endforeach
