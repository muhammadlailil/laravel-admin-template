<div class="md:max-w-[80%]  flex flex-col gap-4">
    <x-input type="text" id="name" name="name" label="Nama" required placeholder="Nama Role" />
    <x-input.select id="is_superadmin" name="is_superadmin" label="Superadmin" required>
        <option value="">Pilih</option>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </x-input.select>
    <div class="flex gap-2 align-baseline">
        <div class="flex-1 min-w-[170px] block">
            <label for="[ermission" class="text-[12px]">
                Permissions
            </label>
            <span class="text-red-500 text-[12px] font-krub-bold">*</span>
        </div>

        <div class="w-full">
            <div class="d-flex mb-3">
                <button type="button"
                    class="border rounded-lg text-[11px] px-3 py-2 font-krub-medium btn-select-all">SELECT ALL</button>
                <button type="button" class="border rounded-lg text-[11px] px-3 py-2 font-krub-medium btn-unselect">UN
                    SELECT ALL</button>
            </div>
            <div class="flex gap-3" id="list-module-permission">
                @php
                    $listed = array_chunk($modules, ceil(count($modules) / 2));
                    $left = @$listed[0] ?? [];
                    $right = @$listed[1] ?? [];
                @endphp
                <div class="col-sm-6">
                    <ul class="list-permission list-group ps-0">
                        @foreach (@$left as $row)
                            <li class="list-group-item p-0">
                                <h6 class="font-krub-semibold text-[14px]">{{ @$row['name'] }}</h6>
                                <li class="list-group-item mb-4">
                                    <ul class="p-0">
                                        <li class="list-group-item p-2 ps-0">
                                            <x-input.checkbox.option name="permissions[]"
                                                value="add:admin-{{ str()->slug($row['id']) }}"
                                                id="add:admin-{{ str()->slug($row['id']) }}"
                                                label="add {{ str()->slug($row['id'], ' ') }}" />
                                        </li>
                                        <li class="list-group-item p-2 ps-0">
                                            <x-input.checkbox.option name="permissions[]"
                                                value="view:admin-{{ str()->slug($row['id']) }}"
                                                id="view:admin-{{ str()->slug($row['id']) }}"
                                                label="view {{ str()->slug($row['id'], ' ') }}" />
                                        </li>
                                        <li class="list-group-item p-2 ps-0">
                                            <x-input.checkbox.option name="permissions[]"
                                                value="edit:admin-{{ str()->slug($row['id']) }}"
                                                id="edit:admin-{{ str()->slug($row['id']) }}"
                                                label="edit {{ str()->slug($row['id'], ' ') }}" />
                                        </li>
                                        <li class="list-group-item p-2 ps-0">
                                            <x-input.checkbox.option name="permissions[]"
                                                value="delete:admin-{{ str()->slug($row['id']) }}"
                                                id="delete:admin-{{ str()->slug($row['id']) }}"
                                                label="delete {{ str()->slug($row['id'], ' ') }}" />
                                        </li>
                                    </ul>
                                </li>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="list-permission list-group ps-0">
                        @foreach (@$right as $key)
                            <li class="list-group-item ">
                                <h6 class="font-krub-semibold text-[14px]">{{ @$key['name'] }}</h6>
                                <li class="list-group-item mb-4">
                                    <ul class="p-0">
                                        <li class="list-group-item p-2 ps-0">
                                            <x-input.checkbox.option name="permissions[]"
                                                value="add:admin-{{ str()->slug($key['id']) }}"
                                                id="add:admin-{{ str()->slug($key['id']) }}"
                                                label="add {{ str()->slug($key['id'], ' ') }}" />
                                        </li>
                                        <li class="list-group-item p-2 ps-0">
                                            <x-input.checkbox.option name="permissions[]"
                                                value="view:admin-{{ str()->slug($key['id']) }}"
                                                id="view:admin-{{ str()->slug($key['id']) }}"
                                                label="view {{ str()->slug($key['id'], ' ') }}" />
                                        </li>
                                        <li class="list-group-item p-2 ps-0">
                                            <x-input.checkbox.option name="permissions[]"
                                                value="edit:admin-{{ str()->slug($key['id']) }}"
                                                id="edit:admin-{{ str()->slug($key['id']) }}"
                                                label="edit {{ str()->slug($key['id'], ' ') }}" />
                                        </li>
                                        <li class="list-group-item p-2 ps-0">
                                            <x-input.checkbox.option name="permissions[]"
                                                value="delete:admin-{{ str()->slug($key['id']) }}"
                                                id="delete:admin-{{ str()->slug($key['id']) }}"
                                                label="delete {{ str()->slug($key['id'], ' ') }}" />
                                        </li>
                                    </ul>
                                </li>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

@push('js')
    <script>
        document.querySelector('.btn-select-all').addEventListener('click', function() {
            document.querySelectorAll('#list-module-permission .input-checkbox').forEach((
                item) => {
                item.checked = true
            })
        })
        document.querySelector('.btn-unselect').addEventListener('click', function() {
            document.querySelectorAll('#list-module-permission .input-checkbox').forEach((
                item) => {
                item.checked = false
            })
        })
    </script>
@endpush
