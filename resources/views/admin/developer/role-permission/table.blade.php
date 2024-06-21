@foreach ($data as $row)
    <tr>
        <x-table.td>
            <div class="flex gap-2 justify-start">
                <x-button.edit href="{{ adminRoute('admin.role-permission.edit', $row->uuid) }}" />
                <x-button.delete data-action="{{ adminRoute('admin.role-permission.destroy', $row->uuid) }}" />
            </div>
        </x-table.td>
        <x-table.td>
            {{ $row->name }}
        </x-table.td>
        <x-table.td>
            <i class="text-[10px]">{{ $row->is_superadmin ? 'Superadmin' : 'None' }}</i>
        </x-table.td>
    </tr>
@endforeach
