@foreach ($data as $row)
    <tr>
        <x-table.td>
            <div class="flex gap-2 justify-start">
                <x-button.edit href="{{ adminRoute('admin.user-management.edit', $row->uuid) }}" />
                <x-button.delete data-action="{{ adminRoute('admin.user-management.destroy', $row->uuid) }}" />
            </div>
        </x-table.td>
        <x-table.td>
            <div class="flex gap-2 items-center">
                <img src="{{ asset($row->profile) }}" alt="Profile" class="w-[30px] h-[30px] rounded-full object-cover">
                {{ $row->email }}
            </div>
        </x-table.td>
        <x-table.td>
            {{ $row->name }}
        </x-table.td>
        <x-table.td>
            {{ $row->roles?->name }}
        </x-table.td>
    </tr>
@endforeach