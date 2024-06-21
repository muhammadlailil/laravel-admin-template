<div class="md:max-w-[80%]  flex flex-col gap-4">
    <x-input type="text" id="name" name="name" label="Nama" required placeholder="Nama Role"
        :value="old('name') ?: $row->name" />
    <x-input type="email" id="email" name="email" label="Email" required placeholder="Email" :value="old('email') ?: $row->email" />
    <x-input.select id="role_permission_id" name="role_permission_id" label="Role" required>
        <option value="">Pilih</option>
        @foreach ($roles as $role)
            <option @selected(old('role_permission_id') ?: $row->role_permission_id == $role->id) value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </x-input.select>
    <x-input.password id="password" name="password" label="Password" placeholder="Password"
        information="Biarkan kosong jika tidak ingin mengubah password" />
</div>
