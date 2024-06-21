<x-layout.admin title="Edit Profile">
    <form action="{{ route('admin.profile.store') }}" class="bg-white rounded-lg border mx-4 my-4 flex flex-col"
        method="POST" enctype='multipart/form-data' id="form-main-process">
        @csrf
        <div class="px-5 py-3 border-b flex justify-between items-center">
            <h1 class="font-krub-medium text-[16px]" id="form-page-title">
                Edit Profile
            </h1>
            <div class="flex gap-3">
                <x-button.orange type="submit" label="Submit" elementClass="py-[10px]" />
            </div>
        </div>
        <div class="px-5 py-5 max-h-[calc(100vh-170px)] overflow-auto">
            <div class="md:max-w-[80%]  flex flex-col gap-4 mb-5">
                <x-input type="text" id="email" name="email" label="Email" disabled placeholder="Email"
                    :value="$user?->email" />
                <x-input type="text" id="name" name="name" label="Nama" placeholder="Nama"
                    :value="$user?->name" />
                    <br>
            </div>
            <hr>
            <div class="md:max-w-[80%]  flex flex-col gap-4 pb-[5%] mt-5">
               <x-input.password id="kata_sandi_lama" name="kata_sandi_lama" label="Old Password" placeholder="Old Password"/>
               <x-input.password id="kata_sandi_baru" name="kata_sandi_baru" label="New Password" placeholder="New Password"/>
               <x-input.password id="ulangi_kata_sandi" name="ulangi_kata_sandi" label="Repeat New Password" placeholder="Repeat New Password"/>
           </div>
        </div>
    </form>
</x-layout.admin>
